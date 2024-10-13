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
[user-profiles] All User Profiles ()
[users-online-status] All Users ProfiOnline Status ()
[user-myself] User Attributes (uniqueid)
[user-album] User Photo & Video Album (uniqueid)
[user-activity] User Profile (uniqueid)
[new-user-activity] New User Activity (uniqueid)
[user-interests] User Interests (uniqueid)
[user-preference] User Prefences (uniqueid)
[user-language] User Language (uniqueid)
[user-workeducation] User Work & Education (uniqueid)
[update-profile-photo] Update Profile Image (uniqueid, username, profileimage)
[update-cover-photo] Update Cover Image (uniqueid, username, coverimage)
[update-myself] Update User Self Attributes (uniqueid, orientation, ethnicity, dress, pets, drinking, smoking, eating, race, color, details)

[update-preference] Update User Self Attributes (uniqueid, orientation, ethnicity, dress, pets, drinking, smoking, eating, race, color, details)

[user-find-people] Find Matches (uniqueid)
[user-random-people] Find Random Matches (uniqueid)
[user-views] Create User Profile Views (uniqueid)
[user-actions] Create User Profile Action (uniqueid)
[user-add-buddy] Add Buddy Request (uniqueid, buddyid, request)
[user-accept-buddy] Accept Buddy Request (uniqueid, buddyid)
[user-buddies-count] User Buddies Count (uniqueid)
[user-chat-messages] User Buddies Messages (uniqueid, buddyid)
[user-buddies-list] User Buddies List (uniqueid)
[get-latest-posts] New User Posts ()
[get-post] New User Posts (postid)
[get-latest-posts-files] New User Posts Files()
[post-comments] All Post Comments (postid)
[new-comment] Add a Comment (postid, details)
[post-views] Post Views (postid)
[post-likes] Post Likes (postid)
[post-dislikes] Post Dislikes (postid)
[user-post-interaction] Post Interaction (postid, uniqueid, username, )
[user-post-reports] Post Interaction (postid, uniqueid, username, reason)
[user-post-comment] Post Comment (postid, uniqueid, username, details)
[user-post-status] Post Delete (postid, uniqueid, username, status)
[get-post-interactions] Post Interactions (postid)
[new-message-count] New Message Count (uniqueid)


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
[online-now-count] Logged In Users Count ()
[end-session] Log Users Out (uniqueid, username, )
[deactivate-account] Deactivate An Account (uniqueid, username, password, details)