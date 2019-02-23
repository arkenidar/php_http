CREATE TABLE IF NOT EXISTS chat_messages (
id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
message_text TEXT NOT NULL,
sender TEXT NOT NULL,
creation_timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL );