-- 事務所
insert into office (id, office_name, manifest)
  values (1, '法人事務局K', '喧嘩の仲裁をサポートします。');

-- ユーザー
insert into users (login_name, pass_word, office) values ('steinstadt', 'GoodDog5', 1);
