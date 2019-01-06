-- 例.事務所が「法人事務局K」のユーザーの名前
SELECT u.login_name
FROM users u, office o
WHERE u.office=o.id
and o.office_name='法人事務局K';
