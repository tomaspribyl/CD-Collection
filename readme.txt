Popis problému
--------------------------------------------------------

V složce /app/models jsou entity noobs a guilts, mezi nimi je vztah n:m, čili jeden noob může mít více guiltů 
a naopak. Každý noob má minimálně jeden.

Data jsem jen dumpnul na dashboard presenteru v default akci, aby bylo vidět, kde je problém.

	$qb = $this->em->createQueryBuilder();
        $qb->select("n, g");
        $qb->from("NoobDB\Entities\Noobs", "n");
        $qb->leftjoin("n.guilts", "g")->setMaxResults(10);
        $q = $qb->getQuery();
        Nette\Debug::dump($q->getArrayResult());

Pokud zadám bez limitu, je vše OK a data se vypíší všechny v pořádku.
Jenže když zadám třeba limit 10, tak se mi vrátí jen 9 záznamů - 8 záznamů má v tabulce guilts po jednom záznamu, 1 záznam má 2 záznamy
Tzn. jakoby to vrází deset, ale jeden tam je jakoby 2x (i když není vidět).
Vše by bylo v pořádku, kdyby měl každý noob jeden guilt. Prostě teď to funguje tak, že pokud má noob 3 záznamy v tabulce
guilts, bere ho to, jaky by byl 3x... pokud zadám limit 15, vypíše mi to 13 záznamů - 10 co má v tabulce guilts 1 záznam, a 2 co mají v tabulce guilt po dvou záznamech....