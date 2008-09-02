/********************* ROLES **********************/

/********************* UDFS ***********************/

/****************** GENERATORS ********************/

CREATE GENERATOR GEN_MOVIES_ID;
CREATE GENERATOR GEN_POSTS_ID;
/******************** DOMAINS *********************/

/******************* PROCEDURES ******************/

/******************** TABLES **********************/

CREATE TABLE MOVIES
(
  ID Integer NOT NULL,
  FILENAME Varchar(512) NOT NULL,
  PRIMARY KEY (ID)
);
CREATE TABLE POSTS
(
  ID Integer NOT NULL,
  TITLE Varchar(50) NOT NULL,
  BODY Varchar(2000) NOT NULL,
  CREATED Timestamp NOT NULL,
  MODIFIED Timestamp NOT NULL,
  PRIMARY KEY (ID)
);
/********************* VIEWS **********************/

/******************* EXCEPTIONS *******************/

/******************** TRIGGERS ********************/

SET TERM ^ ;
CREATE TRIGGER MOVIES_BI FOR MOVIES ACTIVE
BEFORE INSERT POSITION 0
AS

BEGIN

IF (NEW.ID IS NULL) THEN

NEW.ID = GEN_ID(GEN_MOVIES_ID, 1);

END^
SET TERM ; ^
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
 ON MOVIES TO SYSDBA WITH GRANT OPTION;

GRANT DELETE, INSERT, REFERENCES, SELECT, UPDATE
 ON POSTS TO SYSDBA WITH GRANT OPTION;



INSERT INTO "POSTS" ("TITLE","BODY","MODIFIED","CREATED") VALUES ('Foo bazz bar','test blog ','now','now');

INSERT INTO "POSTS" ("TITLE","BODY","MODIFIED","CREATED") VALUES (' bazz bar Foo','test blog2 ','now','now');

