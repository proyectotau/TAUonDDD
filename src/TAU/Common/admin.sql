PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS "user_group";
DROP TABLE IF EXISTS "group_role";
DROP TABLE IF EXISTS "role_module";

DROP TABLE IF EXISTS "User";

CREATE TABLE "User" (
	"user_pk"   INTEGER NOT NULL,
	"user_id"	TEXT NOT NULL UNIQUE,
	"name"      TEXT,
	"surname"   TEXT,
	"login"     TEXT,
	PRIMARY KEY("user_pk" AUTOINCREMENT)
);

DROP TABLE IF EXISTS "Group";

CREATE TABLE "Group" (
	"group_pk"  INTEGER NOT NULL,
	"group_id"  TEXT NOT NULL UNIQUE,
	"name"      TEXT,
	"description" TEXT,
	PRIMARY KEY("group_pk" AUTOINCREMENT)
);

DROP TABLE IF EXISTS "Role";

CREATE TABLE "Role" (
	"role_pk"   INTEGER NOT NULL,
	"role_id"   TEXT NOT NULL UNIQUE,
	"name"      TEXT,
	"description" TEXT,
	PRIMARY KEY("role_pk" AUTOINCREMENT)
);

DROP TABLE IF EXISTS "Module";

CREATE TABLE "Module" (
	"module_pk"     INTEGER NOT NULL,
	"module_id"     TEXT NOT NULL UNIQUE,
	"name"          TEXT,
	"description"   TEXT,
	PRIMARY KEY("module_pk" AUTOINCREMENT)
);

CREATE TABLE "user_group" (
	"user_fk"   INTEGER NOT NULL,
	"group_fk"	INTEGER NOT NULL,
	"user_id"	TEXT NOT NULL,
	"group_id"	TEXT NOT NULL,
	FOREIGN KEY("user_fk") REFERENCES User("user_pk")
	    ON DELETE CASCADE
	    ON UPDATE CASCADE,
    FOREIGN KEY("group_fk") REFERENCES "Group"("group_pk")
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    UNIQUE("user_fk","group_fk"),
    UNIQUE("user_id","group_id")
);

CREATE TABLE "group_role" (
	"group_fk"	INTEGER NOT NULL,
    "role_fk"   INTEGER NOT NULL,
    "group_id"	TEXT NOT NULL,
	"role_id"	TEXT NOT NULL,
    FOREIGN KEY("group_fk") REFERENCES "Group"("group_pk")
        ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY("role_fk") REFERENCES Role("role_pk")
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    UNIQUE("group_fk","role_fk"),
    UNIQUE("group_id","role_id")
);

CREATE TABLE "role_module" (
	"role_fk"   INTEGER NOT NULL,
    "module_fk"	INTEGER NOT NULL,
    "role_id"	TEXT NOT NULL,
    "module_id"	TEXT NOT NULL,
    FOREIGN KEY("role_fk") REFERENCES Role("role_pk")
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY("module_fk") REFERENCES Module("module_pk")
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    UNIQUE("role_fk","module_fk"),
    UNIQUE("role_id","module_id")
);
