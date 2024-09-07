# Web Application For Dating Services
  Allure Dating API

### Changelog

#### V 1.0.0
Initial Release

#### Requirenment 
PHP >= 5.6

### Author
[Information Technology & Media Network] (www.itm-network.com/)
[Oluniyi Benjamin] (www.github.com/BusyBrainDotNet/)

### Setup
Set Basic Info in the htaccess file

### Endpoints

## Test
[/] index page
[sayhello] Test Connection

## App Information
[coy-info] Company Information ()
[visitor-info] Track Visitor Information (ip, user_agent, date, time)


## Registration & Login
[create-user] Create User (fname, lname, email, gender, dob, ip, user_agent)
[confirm-email] Confirm Email ID (uniqueid, key)
[forgot-password] Forgot Password (email)
[get-user-passcode] Send User Info (email)
[reset-password] Reset Password (email, key, password)
[unlock-dashboard] Unlock User Dashboard (email, code)
[confirm-login] User Login to Dashboard (email, password)
[confirm-subscriber] Subscribe To Newsletter (email, ip, user_agent)
[contact-us] Send Contact Form (fname, lname, email, phone, subject, details, ip, user_agent)


## User Dashboard
[user-profile] User Profile (fname, lname, email, gender, dob, about)
[user-album] User Photo & Video Album (uniqueid)
[user-activity] User Profile (uniqueid)
[user-interests] User Interests (uniqueid)
[user-preference] User Prefences (uniqueid)
[user-language] User Language (uniqueid)
[user-workeducation] User Work & Education (uniqueid)

[all-ads] User Posts ()
[ads-comments] Post Comments (postid)
[add-comment] Add a Comment (postid, details)

## Admin Dashboard
[admin-info] User Credentails (uniqueid)

## General
[user-info] User Credentails (uniqueid)
[update-username] User Updates Username (uniqueid, username, newUsername)
[update-password] User Updates Password (uniqueid, username, oldpass, newpass)
[update-bio] User Updates Bio Details (uniqueid, username, fname, lname, number, occupation, gender, dob, details)
[new-interest] Create New Interest (uniqueid, username, interest)
[new-location] Create New Location (uniqueid, username, address, city, country)
[new-language] Create New Interest (uniqueid, username, lang)
[new-workneducation] Create New Work Or Education Info (uniqueid, username, name, from, to, category, details)
[end-session] Log Users Out (uniqueid, username, )
[deactivate-account] Deactivate An Account (uniqueid, username, password, details)