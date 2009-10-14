BEGIN TRANSACTION;
CREATE TABLE account (id integer primary key auto_increment, requestor varchar(50), owner varchar(50), secondary varchar(50), email varchar(150), site_url varchar(150), active binary NOT NULL, code_pref enum('copy-paste','include','both'), created_date datetime, modified_date datetime, last_accessed datetime);
COMMIT;
