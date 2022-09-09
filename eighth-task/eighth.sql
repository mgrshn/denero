SELECT users.id, objects.name, users.email, users.password, status.status, objects.last_login, objects.created
FROM users, objects, status
WHERE status.id == 1 AND objects.created > '2020-01-01' AND users.object_id == objects.id AND objects.status_id == status.id