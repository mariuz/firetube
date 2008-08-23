/****************** GENERATORS ********************/

CREATE GENERATOR GEN_POSTS_ID;

/******************** TABLES **********************/

CREATE TABLE POSTS

(

ID Integer NOT NULL,

TITLE Varchar(50),

BODY Varchar(2000),

CREATED Timestamp,

MODIFIED Timestamp,

PRIMARY KEY (ID)

);

/******************** TRIGGERS ********************/

SET TERM ^ ;

CREATE TRIGGER POSTS_BI FOR POSTS ACTIVE

BEFORE INSERT POSITION 0

AS

BEGIN

IF (NEW.ID IS NULL) THEN

NEW.ID = GEN_ID(GEN_POSTS_ID, 1);

END^

SET TERM ; ^

GRANT DELETE, INSERT, REFERENCES, SELECT, UPDATE

ON POSTS TO SYSDBA WITH GRANT OPTION;
INSERT INTO "POSTS" ("TITLE","BODY","MODIFIED","CREATED") VALUES ('Foo bazz bar','test blog ','now','now');

INSERT INTO "POSTS" ("TITLE","BODY","MODIFIED","CREATED") VALUES (' bazz bar Foo','test blog2 ','now','now');

