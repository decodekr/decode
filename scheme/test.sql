SELECT *,(case when details like '%seamless%' then 1 else 0 end + case when details like '%"2inch%' then 1 else 0 end + 

(case when  details like '%A106-B%' then 1 else 0 end)



)/3 AS match_rate 

FROM product_lists WHERE  (details like '%seamless%' OR details like '%"2inch%' OR (details like '%A106-B%' OR details like '%A516-60 or 70%' OR details like '%A516-60 or 70%' OR details like '%PS410%' OR details like '%PT410(W)%' OR details like '%WPC%' OR details like '%A106-C%' OR details like '%A515-70%' OR details like '%A105%' OR details like '%HT49%' OR details like '%HT49(W)%' OR details like '%SPHT49%' OR details like '%SBB49%' OR details like '%STPT480%' OR details like '%SB49%' OR details like '%3602-Steel 35%' OR details like '%WPC%' OR details like '%A106-C%' OR details like '%A516-70%' OR details like '%A516-70%' OR details like '%PS480%' OR details like '%PT480(W)%')) AND category like "%pipe%" ORDER BY match_rate desc LIMIT 0,10