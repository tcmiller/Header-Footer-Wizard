BEGIN TRANSACTION;
CREATE TABLE footer (id integer primary key autoincrement, blockw binary, wordmark binary, patch varchar(50), created_date datetime, last_modified datetime, account_id integer);
COMMIT;
