
use burger_bear;

drop table if exists User;

create table User
	(
		userid int unsigned not null auto_increment primary key,
		username varchar(50),
		password varchar(50),
		phone varchar(50),
		email varchar(50),
		address varchar(50),
		imgurl text,
		gender varchar(10)
	);


	drop table if exists Menu;

	create table Menu
		(
			foodid int unsigned not null auto_increment primary key,
			name varchar(50),
			category varchar(50),
			price varchar(50),
			description text,
			imgurl text
		);

		drop table if exists FoodOrder;

		create table FoodOrder
			(
				orderid varchar(50)  not null primary key,
				userid int unsigned not null,
				amount float(6,2),
				status varchar(50),
				foodlist varchar(50),
				address text,
				contact varchar(20),
				timestamp varchar(50)
			);

			drop table if exists Feedback;

			create table Feedback
				(
					userid int unsigned not null,
					date date not null,
					feedback text
				);


				insert into User values
					(1,"Jack","jack003","84839283","jack003@foxmail.com","21 lien ying chew","null","Male"),
					(2,"Bob","Bob001","84839283","Bob@foxmail.com","21 lien ying chew","null","Male"),
					(3,"Marry","Marry007","84839283","Marry@foxmail.com","21 lien ying chew","null","Male"),
					(4,"Lisa","Lisa004","84839283","Lisa@foxmail.com","21 lien ying chew","null","Male"),
					(5,"Ham","Ham001","84839283","Ham@foxmail.com","21 lien ying chew","null","Male");

					insert into Menu values
						(1,"beefburger","burger","3.2","burger with beef","asset/img/menu/burger/beefburger.jpg"),
						(2,"coke","drink","1.2","cold drink","asset/img/menu/drink/coke.jpg"),
						(3,"bigmac","burger","2.8","burger with beef","asset/img/menu/burger/bigmac.png"),
						(4,"classic","burger","2.5","burger with beef","asset/img/menu/burger/classic.png"),
						(5,"double chicken","burger","3.4","burger with beef","asset/img/menu/burger/doublechicken.png"),
						(6,"cokezero","drink","1.6","cold drink","asset/img/menu/drink/cokezero.png"),
						(7,"mountaindew","drink","1.3","cold drink","asset/img/menu/drink/mountaindew.png"),
						(8,"milkshake","drink","1.8","cold drink","asset/img/menu/drink/strawberrymilkshake.png"),

						(9,"biscuit","sides","0.8","burger with beef","asset/img/menu/sides/biscuit.png"),
						(10,"catfish","sides","1.8","burger with beef","asset/img/menu/sides/catfish.png"),
						(11,"cookie","sides","0.4","burger with beef","asset/img/menu/sides/cookie.png"),
						(12,"waffle","sides","0.7","burger with beef","asset/img/menu/sides/waffle.png"),

						(13,"cake","dessert","0.4","burger with beef","asset/img/menu/dessert/cake.png"),
						(14,"coldstone","dessert","0.7","burger with beef","asset/img/menu/dessert/coldstone.png"),

						(15,"meal1","promotion","8.4","burger with beef","asset/img/menu/promotion/meal1.png"),
						(16,"meal2","promotion","9.6","burger with beef","asset/img/menu/promotion/meal2.png"),			
						(17,"meal3","promotion","9.4","burger with beef","asset/img/menu/promotion/meal3.png");


