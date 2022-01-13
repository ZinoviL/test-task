#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
    CREATE USER app_user with encrypted password 'password';
    ALTER ROLE app_user WITH LOGIN;
    CREATE DATABASE app;
    GRANT ALL PRIVILEGES ON DATABASE app TO app_user;
    CREATE DATABASE app_testing;
    GRANT ALL PRIVILEGES ON DATABASE app_testing TO app_user;
EOSQL