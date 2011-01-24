Popis probl�mu
--------------------------------------------------------

V slo�ce /app/models jsou entity noobs a guilts, mezi nimi je vztah n:m, �ili jeden noob m��e m�t v�ce guilt� 
a naopak. Ka�d� noob m� minim�ln� jeden.

Data jsem jen dumpnul na dashboard presenteru v default akci, aby bylo vid�t, kde je probl�m.

	$qb = $this->em->createQueryBuilder();
        $qb->select("n, g");
        $qb->from("NoobDB\Entities\Noobs", "n");
        $qb->leftjoin("n.guilts", "g")->setMaxResults(10);
        $q = $qb->getQuery();
        Nette\Debug::dump($q->getArrayResult());

Pokud zad�m bez limitu, je v�e OK a data se vyp�� v�echny v po��dku.
Jen�e kdy� zad�m t�eba limit 10, tak se mi vr�t� jen 9 z�znam� - 8 z�znam� m� v tabulce guilts po jednom z�znamu, 1 z�znam m� 2 z�znamy
Tzn. jakoby to vr�z� deset, ale jeden tam je jakoby 2x (i kdy� nen� vid�t).
V�e by bylo v po��dku, kdyby m�l ka�d� noob jeden guilt. Prost� te� to funguje tak, �e pokud m� noob 3 z�znamy v tabulce
guilts, bere ho to, jaky by byl 3x... pokud zad�m limit 15, vyp�e mi to 13 z�znam� - 10 co m� v tabulce guilts 1 z�znam, a 2 co maj� v tabulce guilt po dvou z�znamech....