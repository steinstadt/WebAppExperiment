-- 事務所
create table office (
  id serial,
  office_name varchar,
  manifest varchar,
  PRIMARY KEY (id)
);

-- ユーザー
create table users (
  id  serial,
  login_name varchar UNIQUE NOT NULL,
  pass_word varchar NOT NULL,
  score int DEFAULT 0,
  office int,
  PRIMARY KEY (id),
  FOREIGN KEY (office) REFERENCES office (id)
);

-- カテゴリー
create table category (
  id serial,
  category_name varchar,
  mean varchar,
  PRIMARY KEY (id)
);

-- 依頼一覧
create table request (
  id serial,
  client int,
  category int,
  detail varchar,
  title varchar,
  target varchar,
  client_time date default current_date,
  PRIMARY KEY (id),
  FOREIGN KEY (client) REFERENCES users (id),
  FOREIGN KEY (category) REFERENCES category (id)
);

-- 裁判
create table judge (
  id serial,
  master int,
  request int,
  result int,
  reason varchar,
  evaluation int default 0,
  PRIMARY KEY (id),
  FOREIGN KEY (master) REFERENCES users (id),
  FOREIGN KEY (request) REFERENCES request (id)
);

-- 傍聴席一覧
create table chatgroup (
  id serial,
  judge int,
  commentator int,
  message varchar,
  chat_time date DEFAULT current_date,
  PRIMARY KEY (id),
  FOREIGN KEY (judge) REFERENCES judge (id),
  FOREIGN KEY (commentator) REFERENCES users (id)
);

-- チャットテーブル
-- create table chattable1 (
--   id serial,
--   commentator int,
--   message varchar,
--   chat_time time DEFAULT current_time,
--   PRIMARY KEY (id),
--   FOREIGN KEY (commentator) REFERENCES users (id)
-- );
