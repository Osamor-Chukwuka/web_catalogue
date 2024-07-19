An API built with laravel that functions as a web directory, where various websites are listed, categorized and ranked based on user actions.

DOCUMENTATION ON EACH ENPOINT


1. 
Get All Websites

Description: Retrieve a list of all websites, sorted by votes.

HTTP Method: GET

URL: /api/websites

Headers: Content-Type: application/json

Request Parameters: None

Request Example

GET http://127.0.0.1:8000/api/websites/

Response
[
    {
        "id": 21,
        "url": "https://www.netflix.com/ng/",
        "title": "Netflix website",
        "description": "A website belonging to Netflix",
        "created_at": "2024-07-19T07:12:02.000000Z",
        "updated_at": "2024-07-19T07:12:02.000000Z",
        "votes_count": 2
    },
    {
        "id": 3,
        "url": "http://volkman.org/culpa-dolore-impedit-exercitationem-libero-possimus-repellendus-cupiditate-qui.html",
        "title": "Voluptatem consequatur qui aut dolores eius non rerum.",
        "description": "Expedita qui incidunt laboriosam. Neque repudiandae mollitia fuga voluptatibus. Iste error sed error qui non. Excepturi ducimus laboriosam repellendus atque quo impedit quos. Tenetur eum ducimus dolor in eius deserunt.",
        "created_at": "2024-07-19T05:53:54.000000Z",
        "updated_at": "2024-07-19T05:53:54.000000Z",
        "votes_count": 0
    }
]






2. 
Search Websites

Description
Search for websites based on a search term. It checks the URL column, title column, and description column of the website table to see if the search term has a match. It orders the search response based on highest vote first

HTTP Method
GET

URL
/api/websites/search

Headers
Content-Type: application/json

Request Parameters

search: (string) The search term.

Request Example

GET http://127.0.0.1:8000/api/websites/search?search=netflix

Response 
[
    {
        "id": 21,
        "url": "https://www.netflix.com/ng/",
        "title": "Netflix website",
        "description": "A website belonging to Netflix",
        "created_at": "2024-07-19T07:12:02.000000Z",
        "updated_at": "2024-07-19T07:12:02.000000Z",
        "votes_count": 0
    }
]






3. 
Add a Website

Description
Add a new website to the directory.

HTTP Method
POST

URL

/api/websites/add

Headers

Content-Type: application/json

Request Parameters/Body

url (string, required): The URL of the website.

title (string, required): The title of the website.

description (string, optional): The description of the website.

category_ids (array of integers, required): The IDs of the categories to which the website belongs.

Request Example

POST http://127.0.0.1:8000/api/websites/add
Body = {
    "url": "https://www.twitter.com/ng/",
    "title": "Twitter website",
    "description": "A website belonging to Twitter",
    "category_ids": [ 1, 2 ]
}

Response: It returns the newly added website details

{
    "url": "https://www.twitter.com/ng/",
    "title": "Twitter website",
    "description": "A website belonging to Twitter",
    "updated_at": "2024-07-19T09:15:16.000000Z",
    "created_at": "2024-07-19T09:15:16.000000Z",
    "id": 34
}




4. 
Vote/Unvote for a Website

Description

Vote for a website. you can unvote a website by calling this same endpoint. if a user has voted on a website already, and you call this enpoint with the same user id on the same website, the vote is removed (unvoting)

HTTP Method
POST

URL
/api/websites/vote/{id}

Headers

Content-Type: application/json

Request Parameters/Body

user_id (integer, required): The ID of the user voting for the website.

Request Example

POST http://127.0.0.1:8000/api/websites/vote/21

Body = {
    "user_id": 1
}

Response
{
    "message": "Vote added"
} 

OR

{
    "message": "Vote removed"
}



5. 
Delete a Website

Description
Delete a website from the directory.

HTTP Method
DELETE

URL

/api/websites/delete/{id}

Headers

Content-Type: application/json

Request Parameters

id (integer, required): The ID of the website to be deleted.

Request Example

delete http://127.0.0.1:8000/api/websites/delete/1

Response
{
    "message": "Website deleted successfully"
}


LIMITATIONS AND ISSUES
1. 

I Had Issues with Sanctum Authentication. I could not get the token from /sanctum/csrf-cookie endpoint. I need the token first before I can make subsequent requests to the App's endpoint, but I could not get it. I had to move on with other endpoints, with the intention of fixing the Authentication, but beacuse I started working on the challange late, I could not come back to this. So, All the endpoints for now, do not require Authentication