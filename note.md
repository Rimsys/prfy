NOTE
- There is no review_request date on github api, so it means this will depend on your system speed to process the review_request hook and add the date to the table


EDGE CASES
- what if someone requests and removes it
- If a review is requested twice
- Sometimes webhook might not be sent. That is where we need cron task for api calls
