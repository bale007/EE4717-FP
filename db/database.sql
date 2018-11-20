
use f38im;

drop table if exists FoodOrder;

drop table if exists Menu;

drop table if exists User;

drop table if exists Feedback;

drop table if exists SalesOrder;

create table User
	(
		userid int unsigned not null auto_increment primary key,
		username varchar(50),
		password varchar(50),
		phone varchar(50),
		email varchar(50) UNIQUE,
		address varchar(50),
		gender varchar(10)
		);




	create table Menu
		(
			foodid int unsigned not null auto_increment primary key,
			name varchar(50),
			category varchar(50),
			price varchar(50),
			description text,
			imgurl text
			);



		create table FoodOrder
			(
				orderid varchar(50)  not null primary key,
				userid int unsigned,
				amount float(6,2),
				status varchar(50),
				foodlist varchar(50),
				address text,
				contact varchar(20),
				timestamp varchar(50),
				FOREIGN KEY (userid) REFERENCES User(userid)
				);


			create table SalesOrder
				(
					orderid varchar(50)  not null,
					userid int unsigned,
					foodid int,
					amount float(6,2),
					quantity int,
					category varchar(50),
					FOREIGN KEY (userid) REFERENCES User(userid)
					);

				create table Feedback
					(
						userid int unsigned not null,
						date date not null,
						feedback text
						);




					insert into Menu (name,category,price,description,imgurl) values

						("Cheese Burger","burger","3.2","hamburger topped with cheese","asset/img/menu/burger/CheeseBurger.jpg"),
						("Chicken Burger","burger","4.2","sandwich made of a patty of chicken in a bun","asset/img/menu/burger/ChickenBurger.jpg"),
						("Curry Burger","burger","3.7","burger with curry on top","asset/img/menu/burger/CurryBurger.jpg"),
						("Guacamole Burger","burger","5.2","heat grill burger","asset/img/menu/burger/GuacamoleBurger.jpg"),
						("Mexico Burger","burger","3.6","mexican style burger","asset/img/menu/burger/MexicoBurger.jpg"),
						("New York Grill Burger","burger","3.6","new york style cooking burger","asset/img/menu/burger/NewYorkGrillBurger.jpg"),
						("Pax Burger","burger","2.9","Beef Patty, Cheese, Gem Lettuce, Tomato,Brioche Bun","asset/img/menu/burger/PaxBurger.jpg"),
						("SmokyBBQ Burger","burger","4.1","Somky Cooking Style Burger","asset/img/menu/burger/SmokyBBQBurger.jpg"),
						("Tower Burger","burger","4.5","Double Stack Beef Burger","asset/img/menu/burger/TowerBurger.jpg"),
						("Vegan Burger","burger","4.3","It's nade for Vegan","asset/img/menu/burger/VeganBurger.jpg"),

						("Apple Juice","drink","2.2","made with real apple","asset/img/menu/drink/AppleJuice.png"),
						("Apple Tea","drink","1.2","apple jucie in a tea","asset/img/menu/drink/AppleTea.jpg"),
						("Blueberry Smoothie","drink","1.5","made from real blue berry and ice","asset/img/menu/drink/BlueberrySmoothie.jpg"),
						("Honey Lemon","drink","1.6","made from lemon, honey and ice","asset/img/menu/drink/HoneyLemon.jpg"),
						("Lemon Tea","drink","1.4","lemon juice in a tea","asset/img/menu/drink/LemonTea.jpg"),
						("Orange Juice","drink","1.8","made with real Oranger","asset/img/menu/drink/OrangeJuice.jpg"),
						("Pineapple Margerita","drink","3.2","cocktail made with pineapple","asset/img/menu/drink/PineappleMargerita.jpg"),
						("Soy milk","drink","2.2","made from real soy","asset/img/menu/drink/Soymilk.jpg"),
						("Watermelon Juice","drink","1.3","made with real watermelon","asset/img/menu/drink/WatermelonJuice.jpg"),
						("Wry Grin Cocktail","drink","4.2","cocktail made with wry grin","asset/img/menu/drink/WryGrinCocktail.jpg"),


						("Baby Potatoes","sides","4.2","roasted Potatoes","asset/img/menu/sides/BabyPotatoes.jpg"),
						("Baked Veggie","sides","3.3","backed style veggie","asset/img/menu/sides/BakedVeggie.jpg"),
						("Cracked Marinative Olives","sides","3.8","made with real olives","asset/img/menu/sides/CrackedMarinativeOlives.jpg"),
						("Crispy Thick Cut Fries","sides","3.4","thick cut fries","asset/img/menu/sides/CrispyThickCutFries.jpg"),
						("Fried Rice","sides","3.7","fries rices with seafood","asset/img/menu/sides/FriedRice.jpg"),
						("Mexican Style Veggie","sides","2.8","a mexican style food","asset/img/menu/sides/MexicanStyleVeggie.jpg"),
						("Mini Corn Dogs","sides","4.2","nice mini corn","asset/img/menu/sides/MiniCornDogs.jpg"),
						("Roasted Shrimp with Tomatoes","sides","5.2","shrimp roasted with tomatoes","asset/img/menu/sides/RoastedShrimpwithTomatoes.jpg"),
						("Stewed Veggie","sides","4.2","a Stewed style veggie","asset/img/menu/sides/StewedVeggie.jpg"),
						("Sweet Potato Pecan Souffle","sides","3.5","a very nice sweet potato","asset/img/menu/sides/SweetPotatoPecanSouffle.jpg"),


						("Apple Tart","dessert","1.2","tart with apple","asset/img/menu/dessert/AppleTart.jpg"),
						("Cheese Cake","dessert","3.2","cake with cheese","asset/img/menu/dessert/CheeseCake.jpg"),
						("Chocolake Gelato","dessert","3.4","gelato made of chocolake","asset/img/menu/dessert/ChocolateGelato.jpg"),
						("Coffee Cupcake","dessert","2.5","made with real coffee bean","asset/img/menu/dessert/CoffeeCupcake.jpg"),
						("Cream Puff","dessert","1.2","made with real cream and puff","asset/img/menu/dessert/CreamPuff.jpg"),
						("Eggtarts","dessert","1.2","classic tart","asset/img/menu/dessert/Eggtarts.jpg"),
						("Macarons","dessert","2.2","nice little cake","asset/img/menu/dessert/Macarons.jpg"),
						("Macha Crepe Cake","dessert","4.2","origined from ladyM","asset/img/menu/dessert/MachaCrepeCake.jpg"),
						("Strawberry Tiramisu","dessert","5.4","cake made with strawberry","asset/img/menu/dessert/StrawberryTiramisu.jpg"),
						("Waffle","dessert","2.0","classic waffle","asset/img/menu/dessert/Waffle.jpg"),

						("Value Box 1","promotion","10.0","hotdog, fris and sandwich","asset/img/menu/promotion/meal1.jpg"),
						("Value Box 2","promotion","9.0","classic burger and fries","asset/img/menu/promotion/meal2.jpg"),
						("Value Box 3","promotion","9.5","burger, fries and coke","asset/img/menu/promotion/meal3.jpg"),
						("Value Box 4","promotion","9.5","burger, potato with bacon and coke","asset/img/menu/promotion/meal4.jpg"),
						("Value Box 5","promotion","8.7","full fried chicken, drinks, fries and snacks","asset/img/menu/promotion/meal5.jpg"),
						("Value Box 6","promotion","9.5","full fried chicken, drinks, fries and more snacks","asset/img/menu/promotion/meal6.jpg"),
						("Value Box 7","promotion","7.6","burger, potato with bacon and coke","asset/img/menu/promotion/meal7.jpg"),
						("Value Box 8","promotion","12.3","double urger and potato fries","asset/img/menu/promotion/meal8.jpg"),
						("Value Box 9","promotion","10.5","sandwich with cheese potato chips","asset/img/menu/promotion/meal9.jpg");

