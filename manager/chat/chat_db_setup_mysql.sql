create database if not exists chat;
use chat;

CREATE TABLE IF NOT EXISTS chat.chat_messages (
id SERIAL PRIMARY KEY NOT NULL,
message_text TEXT NOT NULL,
sender TEXT NOT NULL,
creation_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL );	
