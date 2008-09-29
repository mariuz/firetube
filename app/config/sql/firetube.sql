connect "/var/lib/firebird/2.1/data/firetube.fdb";
/********************* ROLES **********************/

/********************* UDFS ***********************/

CREATE GENERATOR GEN_POSTS_ID;
commit;
/******************** DOMAINS *********************/

/******************* PROCEDURES ******************/

/******************** TABLES **********************/

CREATE TABLE FIREBIRD_SERVERS
(
 ID Integer NOT NULL,
 SERVER_NAME Varchar(512) NOT NULL
);
commit;
CREATE TABLE GLOBAL_MOVIES_ID
(
 GLOBAL_ID integer NOT NULL,
 LOCAL_ID integer NOT NULL,
 PRIMARY KEY (ID)
);				
commit;
CREATE TABLE POSTS
(
  ID Integer NOT NULL,
  TITLE Varchar(50) NOT NULL,
  BODY Varchar(2000) NOT NULL,
  CREATED Timestamp NOT NULL,
  MODIFIED Timestamp NOT NULL,
  PRIMARY KEY (ID)
);
commit;
/********************* VIEWS **********************/

/******************* EXCEPTIONS *******************/

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
commit;


INSERT INTO "POSTS" ("TITLE","BODY","MODIFIED","CREATED") VALUES ('Foo bazz bar','test blog ','now','now');

INSERT INTO "POSTS" ("TITLE","BODY","MODIFIED","CREATED") VALUES (' bazz bar Foo','test blog2 ','now','now');
commit;


