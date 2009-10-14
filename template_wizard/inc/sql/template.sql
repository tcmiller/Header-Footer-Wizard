BEGIN TRANSACTION;
CREATE TABLE account (id integer primary key auto_increment, requestor varchar(50), owner varchar(50), secondary varchar(50), email varchar(150), site_url varchar(150), active binary NOT NULL, code_pref enum('copy-paste','include','both'), created_date datetime, modified_date datetime, last_accessed datetime);
CREATE TABLE header (id integer primary key auto_increment, kitchen_sink binary, blockw binary, wordmark binary, color enum('purple','gold'), search ('basic','super-inline','super-tab'), created_date datetime, last_modified datetime, account_id integer);
CREATE TABLE footer (id integer primary key autoincrement, blockw binary, wordmark binary, patch enum('purple','gold','0'), created_date datetime, last_modified datetime, account_id integer);
COMMIT;
