BEGIN TRANSACTION;
CREATE TABLE header (id integer primary key auto_increment, kitchen_sink binary, blockw binary, wordmark binary, color enum('purple','gold'), search ('basic','super-inline','super-tab'), created_date datetime, last_modified datetime, account_id integer);
COMMIT;
