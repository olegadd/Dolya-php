-- Запрос 1
SELECT * FROM public.users;


-- Запрос 2
SELECT o.*
FROM public.orders o
JOIN public.users u ON o.user_id = u.id
WHERE u.name LIKE 'Иванов%';

-- Запрос 3
SELECT DISTINCT u.id, u.name
FROM public.users u
JOIN public.orders o ON u.id = o.user_id;

-- Запрос 4
SELECT u.*, o.*
FROM public.users u
JOIN public.orders o ON u.id = o.user_id
WHERE o.created_at = (SELECT MAX(created_at) FROM public.orders);

-- Запрос 5
SELECT *
FROM public.orders
WHERE created_at <= '2023-03-31';