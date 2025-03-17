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
[get-latest-blog-posts] Get Latest Blog Posts Info   ()
[get-random-blog-posts] Get Random Blog Posts Info   ()
[get-blog-posts-actions] Get Blog Posts Actions    ()
[get-blog-post-details] Get Blog Post Details (postid)
[blog-post-views] Blog Post Views      ()
[blog-post-action] Blog Post Action    ()
[search-blog-post] Search Blog Posts (title)

## User Dashboard
[user-profile] User Profile (fname, lname, email, gender, dob, about)
[user-profiles] All User Profiles ()
[users-online-status] All Users ProfiOnline Status ()
[user-myself] User Attributes (uniqueid)
[user-preference] User Prefences (uniqueid)
[user-album] User Photo & Video Album (uniqueid)
[user-activity] User Profile (uniqueid)
[new-user-activity] New User Activity (uniqueid)
[user-interests] User Interests (uniqueid)
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
[user-chat-reply] User Buddies Chat (uniqueid, sender, receiver, details, chatid)
[user-chat-messages] User Buddies Messages (uniqueid, buddyid)
[user-buddies-list] User Buddies List (uniqueid)
[user-create-post] User Create New Post (uniqueid, post, Images)
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
[new-message-details] New Message Count (uniqueid)
[new-chat-count] New Message Count (uniqueid)
[user-chat-connect] Get Chat Details For User (uniqueid)
[user-chat-messages] Get Chat messages For User (uniqueid, buddyinfo)
[new-chat-details] New Message Count (uniqueid)
[all-user-messages] Get all User Emails/Comments (uniqueid)
[all-comment-chats] Get all Post Comments Chats (uniqueid, buddyid, postid, commentid, )
[my-post-action] Get Action Of User On Each Post (uniqueid)
[user-subscription-plan] Get User Subscription Plan (uniqueid)
[user-make-payment] User Make Payment (uniqueid, username, amount, type)
[user-transactions-info] User Transactions Record (uniqueid)
[user-transaction-status] User Transactions Record (uniqueid, status)
[card-payment-info] Card Payment Information For Users    ()
[get-exchange-info] Get Exchange Rate For User To Make Payment   (currency)
[update-activity-status] User Notifications Status (uniqueid, status)
[update-notification-status] User Notifications Status (uniqueid, status)




## Admin Dashboard
[auto-update-transaction-status] Update Transaction Status Automatically
[create-coy-info] Create Coy Credentails (uniqueid, username, coyname, slogan, email, email1, phone, phone1, channel, instagram, facebook, linkedin, twitter, address, status)
[create-bank-info] Create Coy Credentails (uniqueid, username, bankswift, bankname, acctname, acctnum)
[get-bank-info] Get Coy Credentails ()
[create-currency-info] Create Currency Credentails (uniqueid, username, name, currency)
[get-currency-info] Get Currency Credentails ()
[create-exchange-info] Create Exchange Rate Credentails (uniqueid, username, name, currency, rate)
[get-exchange-info] Get Exchange Rate Credentails ()
[create-subscription-info] Create Subscription Priviledge  (uniqueid, username, status)
[get-subscription-info] Get Subscription Priviledge  ()
[create-subscription-plan] Create Subscription Priviledge  (uniqueid, username, type, amount, expiry, details, details1, details2, status)
[get-subscription-plan] Get Subscription Priviledge  ()
[create-api-connect] Create API Connection details    (uniqueid, username, name, url, code, wallet, private, public, status)
[get-api-connect] Get API Connection details    ()
[get-transactions-info] Get All Payment Transactions Info   () 
[all-payment-Transactions] Get Payment Transactions Info   (status) 
[update-transaction-status] Update Transaction Status (uniqueid, username, trancid, status)
[get-users-info] Get Users Info ()
[user-myself-info] User Attributes ()
[user-preferences-info] User Prefences ()
[update-user-status] Update User Status (uniqueid, username, uuniqueid, status)
[update-message-status] Update Message Status (uniqueid, username, id, status)
[get-newsletters-info] Get Newsletter Subscribers Info    ()
[get-messages-info]   Get Messages Info rmation   (status)
[card-payment-information] Get Card Payment Info For Single API (name)
[update-personal-info] Update Peersonal Information (uniqueid, username, email, fname, lname, number, occupation, gender, dob, address, city, country, status, details)
[create-blog-post] Create New Blog Post  (uniqueid, username, title, subject, introduction, tags, category, conclusion, details, url, file, file1, status)
[update-blog-post] Update Blog Post  (postid, uniqueid, username, title, subject, introduction, tags, category, conclusion, details, url, file, file1, status)
[blog-posts] All  Blog Posts  (status)
[blog-post-details]  Blog Post Details  (postid)


[count-new-users] Get The Total Count Of New Users    ()
[count-all-users] Get The Total Count Of All Users    ()
[count-all-visitors] Get The Total Count Of All App Visitors ()
[count-all-activities] Get The Total Count Of All App Activities ()
[count-all-messages] Get The Total Count Of All App Messages ()
[count-new-messages] Get The Total Count Of All App Messages ()
[user-myself-count] Get The Total Count Of Users Myself Settings ()
[user-preference-count] Get The Total Count Of Users Preferences Settings ()
[new-transactions-count] Get The Total Count Of New Transactions ()
[all-transactions-count] Get The Total Count Of All Transactions ()
[new-userposts-count] Get The Total Count Of New User-Posts()
[all-userposts-count] Get The Total Count Of All User-Posts ()
[new-blogposts-count] Get The Total Count Of New Blog-Posts ()
[all-blogposts-count] Get The Total Count Of All Blog-Posts ()




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