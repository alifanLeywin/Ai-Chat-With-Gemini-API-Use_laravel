# Google OAuth Debugging Guide

## Current Status
✅ Laravel Socialite configured correctly  
✅ Environment variables loaded  
✅ OAuth redirect URL working  
❌ OAuth callback failing  

## Google Cloud Console Checklist

### 1. Enable Required APIs
Go to [Google Cloud Console API Library](https://console.cloud.google.com/apis/library) and ensure these APIs are **ENABLED**:

- ✅ **Google+ API** (Legacy but sometimes needed)
- ✅ **Google People API** 
- ✅ **Google Identity and Access Management (IAM) API**

### 2. OAuth 2.0 Configuration
Go to [Google Cloud Console Credentials](https://console.cloud.google.com/apis/credentials):

1. **Application type**: Web application
2. **Authorized redirect URIs**: Add EXACTLY this URL:
   ```
   http://localhost:8000/auth/google/callback
   ```
   
   **Important**: 
   - No trailing slash
   - Exact case sensitivity
   - No extra spaces

### 3. OAuth Consent Screen
Go to [OAuth consent screen](https://console.cloud.google.com/apis/credentials/consent):

1. **User Type**: External (for testing)
2. **App name**: Your app name
3. **User support email**: Your email
4. **Authorized domains**: Leave empty for localhost testing
5. **Scopes**: Add these scopes:
   - `../auth/userinfo.email`
   - `../auth/userinfo.profile`
   - `openid`

### 4. Test Users (if app is not published)
If your OAuth consent screen is not published:
1. Go to "Test users" section
2. Add your Gmail address as a test user

## Debug Steps

### Step 1: Test the redirect URL
Visit: `http://localhost:8000/test-oauth-config`
Should show:
```json
{
  "client_id": "SET",
  "client_secret": "SET", 
  "redirect": "http://localhost:8000/auth/google/callback"
}
```

### Step 2: Test Socialite driver
Visit: `http://localhost:8000/test-socialite`
Should show success status.

### Step 3: Manual OAuth flow test
1. Visit: `http://localhost:8000/auth/google`
2. Should redirect to Google OAuth page
3. Complete Google login
4. Should redirect back to `/auth/google/callback`

### Step 4: Check logs
After failed attempt:
```bash
tail -f storage/logs/laravel.log
```

## Common Errors & Solutions

### Error: "redirect_uri_mismatch"
**Cause**: Redirect URI in Google Console doesn't match exactly
**Solution**: Copy-paste exact URL: `http://localhost:8000/auth/google/callback`

### Error: "access_denied"
**Cause**: OAuth consent screen not configured or user not authorized
**Solution**: Configure consent screen and add test users

### Error: "invalid_client"
**Cause**: Client ID or Secret incorrect
**Solution**: Double-check credentials in .env file

### Error: "This app isn't verified"
**Cause**: OAuth consent screen not published
**Solution**: Click "Advanced" → "Go to [app name] (unsafe)" during testing

## Testing Checklist

- [ ] Google Cloud project created
- [ ] Required APIs enabled
- [ ] OAuth 2.0 Client ID created
- [ ] Redirect URI configured exactly
- [ ] OAuth consent screen configured
- [ ] Test user added (if unpublished)
- [ ] Environment variables set correctly
- [ ] Laravel cache cleared

## Next Steps

If still failing after all checks:
1. Try with a different Google account
2. Create a new OAuth Client ID
3. Check if IP/localhost is blocked by your network
4. Try using `127.0.0.1:8000` instead of `localhost:8000`
