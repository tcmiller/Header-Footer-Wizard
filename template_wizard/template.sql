BEGIN TRANSACTION;
DELETE FROM sqlite_sequence;
CREATE TABLE contact (netid varchar(50) primary key, email varchar(150), active binary, created_date datetime, modified_date datetime, last_accessed datetime, backup varchar(150));
CREATE TABLE footer (id integer primary key autoincrement, blockw binary, wordmark binary, color varchar(50), patch binary, created_date datetime, modified_date datetime, last_accessed datetime, netid varchar(50));
CREATE TABLE header (id integer primary key autoincrement, blockw binary, wordmark binary, color varchar(50), search varchar(50), created_date datetime, modified_date datetime, last_accessed datetime, netid varchar(50));
COMMIT;
