###cantine###

Cantine est un projet de gestion conçu pour faciliter l'inscription des enfants à une cantine. Il a été développé en utilisant le Framework Symfony qui offre une approche orientée objet (POO) ainsi que des outils tels que Composer et Bootstrap. Les parents peuvent ainsi gérer facilement les inscriptions de leurs enfants.


#### base.html.twig ####
ce code représente une structure de base pour une page HTML avec un en-tête de navigation, une barre latérale et une section principale. Voici une explication détaillée du code :

    Le code commence par définir la structure de base de la page HTML avec les balises doctype, html, head et body.
    Dans la balise head, on retrouve la déclaration du jeu de caractères et le titre de la page, qui peut être modifié dans les blocs de contenu spécifiques.
    Ensuite, on trouve quelques balises link pour inclure des feuilles de style Bootstrap et des icônes de police awesome.
    Le code HTML utilise Bootstrap pour la mise en page et le style, en utilisant des classes prédéfinies pour le positionnement des éléments.
    Le code utilise également des blocs Twig, une syntaxe de template utilisée dans le framework Symfony. Ces blocs permettent de remplacer ou d'étendre certaines parties du code dans les fichiers de template spécifiques.
    L'en-tête de la page contient une barre de navigation avec un logo et un nom de marque, ainsi que le nom de l'utilisateur connecté (récupéré à partir de la variable app.user.firstname et app.user.lastname).
    La barre latérale présente un menu avec des liens vers différentes sections de l'application, tels que l'accueil, les parents, les enfants, etc. Certains liens sont conditionnels et ne sont affichés que si l'utilisateur a un certain rôle.
    La section principale de la page est représentée par la balise main, où le contenu spécifique à chaque page peut être inclus dans le bloc Twig body.
    Enfin, à la fin du code, il y a l'inclusion de la bibliothèque JavaScript Bootstrap pour les fonctionnalités avancées.

    
  

 ### adminController.php ###


 Ce code représente un contrôleur Symfony dans une application web pour la gestion des utilisateurs administrateurs. Voici une explication détaillée du code :

    Le contrôleur AdminController est une classe qui étend la classe AbstractController fournie par Symfony.
    Le contrôleur est annoté avec l'attribut #[Route] au niveau de la classe pour préfixer toutes les routes du contrôleur avec /admin.
    Le contrôleur contient plusieurs méthodes d'action, chacune étant associée à une route spécifique.
    La méthode index est associée à la route 'app_admin_index' avec le chemin '/' et la méthode GET. Elle prend en paramètre un objet UserRepository pour récupérer la liste des utilisateurs administrateurs à partir de la base de données. Cette liste est transmise à la vue Twig 'admin/index.html.twig'.
    La méthode new est associée à la route 'app_admin_new' avec le chemin '/new' et les méthodes GET et POST. Elle gère la création d'un nouvel utilisateur administrateur. Elle prend en paramètre un objet Request, un objet UserRepository pour effectuer des opérations sur la base de données, et un objet UserPasswordHasherInterface pour hasher le mot de passe de l'utilisateur. La méthode crée un nouvel objet User, crée un formulaire à partir de la classe User1Type et le traite en fonction de la soumission et de la validité. Si le formulaire est soumis et valide, le rôle de l'utilisateur est défini en tant qu'administrateur, le mot de passe est hashé et l'utilisateur est enregistré en utilisant le UserRepository. Ensuite, l'utilisateur est redirigé vers la liste des utilisateurs administrateurs.   
        Les méthodes show, edit et delete sont associées aux routes 'app_admin_show', 'app_admin_edit' et 'app_admin_delete' respectivement. Elles prennent en paramètre un objet User spécifique et effectuent des opérations pour afficher les détails d'un utilisateur, modifier un utilisateur et supprimer un utilisateur respectivement. Les détails d'un utilisateur sont transmis à la vue Twig correspondante pour être affichés et les modifications sont sauvegardées dans la base de données en utilisant le UserRepository. La méthode delete vérifie également le jeton CSRF pour des raisons de sécurité avant de supprimer l'utilisateur.
 Ce contrôleur permet de gérer les opérations CRUD (Create, Read, Update, Delete) pour les utilisateurs administrateurs dans une application Symfony. Il est utilisé pour afficher la liste des administrateurs, créer de nouveaux administrateurs, afficher les détails d'un administrateur, modifier un administrateur et supprimer un administrateur. Les vues Twig correspondantes doivent être créées séparément pour afficher les informations et les formulaires associés à chaque opération.

 ### ChildController.php ###


 Ce code représente un contrôleur Symfony dans une application web pour la gestion des enfants. Voici une explication détaillée du code :

    Le contrôleur ChildController est une classe qui étend la classe AbstractController fournie par Symfony.
    Le contrôleur est annoté avec l'attribut #[Route] au niveau de la classe pour préfixer toutes les routes du contrôleur avec /child.
    Le contrôleur contient plusieurs méthodes d'action, chacune étant associée à une route spécifique.
    La méthode index est associée à la route 'app_child_index' avec le chemin '/' et la méthode GET. Elle prend en paramètre un objet ChildRepository pour récupérer la liste des enfants à partir de la base de données. La méthode vérifie le rôle de l'utilisateur connecté. Si l'utilisateur est un administrateur, tous les enfants sont récupérés avec la méthode findAll(). Sinon, seuls les enfants associés à l'utilisateur connecté sont récupérés avec la méthode findBy(['user' => $this->getUser()]). La liste des enfants est transmise à la vue Twig 'child/index.html.twig'.
    La méthode new est associée à la route 'app_child_new' avec le chemin '/new' et les méthodes GET et POST. Elle gère la création d'un nouvel enfant. Elle prend en paramètre un objet Request et un objet ChildRepository. La méthode crée un nouvel objet Child, crée un formulaire à partir de la classe ChildType ou ChildAdminType en fonction du rôle de l'utilisateur connecté, puis le traite en fonction de la soumission et de la validité. Si le formulaire est soumis et valide, l'utilisateur associé à l'enfant est défini en tant que l'utilisateur connecté ($this->getUser()) et l'enfant est enregistré en utilisant le ChildRepository. Ensuite, l'utilisateur est redirigé vers la liste des enfants.
        Les méthodes show, edit et delete sont associées aux routes 'app_child_show', 'app_child_edit' et 'app_child_delete' respectivement. Elles prennent en paramètre un objet Child spécifique et effectuent des opérations pour afficher les détails d'un enfant, modifier un enfant et supprimer un enfant respectivement. Les détails d'un enfant sont transmis à la vue Twig correspondante pour être affichés et les modifications sont sauvegardées dans la base de données en utilisant le ChildRepository. La méthode delete vérifie également le jeton CSRF pour des raisons de sécurité avant de supprimer l'enfant.

Ce contrôleur permet de gérer les opérations CRUD (Create, Read, Update, Delete) pour les enfants dans une application Symfony. Il est utilisé pour afficher la liste des enfants, créer de nouveaux enfants, afficher les détails d'un enfant, modifier un enfant et supprimer un enfant. Les vues Twig correspondantes doivent être créées séparément pour afficher les informations et les formulaires associés à chaque opération.

### HomeController.php 

Ce code représente un contrôleur Symfony pour la page d'accueil de l'application. Voici une explication détaillée du code :

    Le contrôleur HomeController est une classe qui étend la classe AbstractController fournie par Symfony.
    Le contrôleur est annoté avec l'attribut #[Route] au niveau de la méthode index(). La route est définie avec le chemin '/home' et le nom 'app_home'.
    La méthode index() est associée à la route 'app_home' et ne prend aucun paramètre. Elle renvoie une réponse HTTP contenant la vue Twig 'home/index.html.twig'. La vue Twig peut accéder à une variable 'controller_name' qui est définie comme 'HomeController'.
    La vue Twig correspondante doit être créée pour afficher le contenu de la page d'accueil.

Ce contrôleur permet d'afficher la page d'accueil de l'application lorsqu'un utilisateur accède à la route '/home'. La vue Twig correspondante peut être personnalisée pour afficher le contenu souhaité.

### RegistrationController.php ###

Ce code représente un contrôleur Symfony pour la gestion des inscriptions des enfants à des menus. Voici une explication détaillée du code :

    Le contrôleur RegistrationController est une classe qui étend la classe AbstractController fournie par Symfony.
    Le contrôleur est annoté avec l'attribut #[Route] au niveau de chaque méthode pour définir les routes correspondantes.
    La méthode index() est associée à la route 'app_registration' avec le chemin '/registration/'. Elle prend en paramètre le ChildRepository et récupère les enfants associés à l'utilisateur actuel. Elle renvoie une réponse HTTP contenant la vue Twig 'registration/index.html.twig' avec la liste des enfants.
    La méthode calcul() est associée à la route 'app_registration_calcul' avec le chemin '/registration/calcul'. Elle prend en paramètre le Request, le ChildRepository et le MenuRepository. Elle effectue le calcul du prix total de la commande en fonction des menus sélectionnés pour chaque enfant. Les données sont récupérées à partir de la requête $request->request. Elle renvoie une réponse HTTP contenant la vue Twig 'registration/calcul.html.twig' avec les informations sur les enfants, le prix total de la commande et enregistre l'objet en session.
    La méthode savecmd() est associée à la route 'app_registration_save' avec le chemin '/registration/save'. Elle prend en paramètre le Request, le ChildRepository, le MenuRepository et le RegistrationRepository. Elle récupère l'objet en session et effectue la sauvegarde des inscriptions des enfants pour les dates sélectionnées. Elle renvoie une réponse HTTP contenant la vue Twig 'registration/save.html.twig'.
    Ce contrôleur permet de gérer les différentes étapes de l'inscription des enfants à des menus. Il affiche les enfants associés à l'utilisateur, effectue le calcul du prix total de la commande et enregistre les inscriptions des enfants pour les dates sélectionnées. Les vues Twig correspondantes doivent être créées pour afficher les informations et les formulaires nécessaires.

### controller    SecurityController.php  ###

Ce code représente un contrôleur Symfony dans une application web. Voici une explication détaillée du code :

    Le contrôleur SecurityController est une classe qui étend la classe AbstractController fournie par Symfony.
    Le contrôleur contient deux méthodes d'action, login et logout, qui sont annotées avec l'attribut #[Route] pour définir les routes correspondantes pour ces actions.
    La méthode login est associée à la route 'app_login' avec le chemin '/'. Elle prend en paramètre un objet AuthenticationUtils, qui est utilisé pour obtenir des informations sur la dernière tentative de connexion (erreur de connexion et dernier nom d'utilisateur).
    À l'intérieur de la méthode login, il y a une vérification commentée pour rediriger vers une autre page (target_path) si l'utilisateur est déjà connecté. Cette vérification peut être utilisée pour rediriger l'utilisateur vers une page spécifique après la connexion.
    Ensuite, la méthode récupère l'erreur de connexion et le dernier nom d'utilisateur à partir de l'objet AuthenticationUtils, et les transmet à la vue Twig 'security/login.html.twig' en utilisant la méthode render de l'objet $this.
    La méthode logout est associée à la route 'app_logout' avec le chemin '/logout'. Cette méthode est vide, car la déconnexion est gérée automatiquement par le système de sécurité de Symfony. L'exception LogicException est levée pour indiquer que cette méthode doit être interceptée par la configuration du pare-feu de Symfony.  


 ### userController.php ###


 Ce code représente un contrôleur Symfony pour la gestion des utilisateurs. Voici une explication détaillée du code :

    Le contrôleur UserController est une classe qui étend la classe AbstractController fournie par Symfony.
    Le contrôleur est annoté avec l'attribut #[Route] au niveau de chaque méthode pour définir les routes correspondantes.
    La méthode index() est associée à la route 'app_user_index' avec le chemin '/user/'. Elle prend en paramètre le UserRepository et récupère les utilisateurs en fonction du rôle. Si l'utilisateur actuel a le rôle administrateur, tous les utilisateurs ayant le rôle parent sont récupérés. Sinon, seul l'utilisateur actuel est récupéré. Elle renvoie une réponse HTTP contenant la vue Twig 'user/index.html.twig' avec la liste des utilisateurs.
    La méthode new() est associée à la route 'app_user_new' avec le chemin '/user/new'. Elle prend en paramètre le Request, le UserRepository et le UserPasswordHasherInterface. Elle crée un nouvel utilisateur, crée un formulaire à partir de la classe UserType et le lie à l'objet utilisateur. Si le formulaire est soumis et valide, le rôle de l'utilisateur est forcé à "ROLE_PARENT", le mot de passe est haché et l'utilisateur est enregistré en base de données. Elle renvoie une réponse HTTP de redirection vers la route 'app_user_index'.   
        La méthode show() est associée à la route 'app_user_show' avec le chemin '/user/{id}'. Elle prend en paramètre l'objet User correspondant à l'identifiant spécifié dans l'URL. Elle renvoie une réponse HTTP contenant la vue Twig 'user/show.html.twig' avec les informations de l'utilisateur.
    La méthode edit() est associée à la route 'app_user_edit' avec le chemin '/user/{id}/edit'. Elle prend en paramètre le Request, l'objet User correspondant à l'identifiant spécifié dans l'URL et le UserRepository. Elle crée un formulaire à partir de la classe UserType et le lie à l'objet utilisateur. Si le formulaire est soumis et valide, l'utilisateur est enregistré en base de données. Elle renvoie une réponse HTTP de redirection vers la route 'app_user_index'.
    La méthode delete() est associée à la route 'app_user_delete' avec le chemin '/user/{id}'. Elle prend en paramètre le Request, l'objet User correspondant à l'identifiant spécifié dans l'URL et le UserRepository. Si le jeton CSRF est valide, l'utilisateur est supprimé de la base de données. Elle renvoie une réponse HTTP de redirection vers la route 'app_user_index'.

Ce contrôleur permet de gérer les opérations de CRUD (Create, Read, Update, Delete) pour les utilisateurs. Il affiche la liste des utilisateurs, permet d'ajouter un nouvel utilisateur, d'afficher les informations d'un utilisateur, de le modifier et de le supprimer. Les vues Twig correspondantes doivent être créées pour afficher les informations et les formulaires nécessaires.


## public  ##
#### index.php ####

Ce code est utilisé dans le fichier public/index.php de votre application Symfony. Il utilise la fonction autoload_runtime.php pour charger automatiquement les classes nécessaires, puis instancie et retourne une instance du noyau (Kernel) de votre application.

Le fichier autoload_runtime.php est généré par Composer et contient des informations sur les classes et les dépendances de votre application.

La fonction retournée est utilisée pour exécuter le noyau de l'application en fonction du contexte fourni. Le contexte est généralement un tableau qui comprend les variables d'environnement (APP_ENV et APP_DEBUG) nécessaires pour initialiser le noyau.

En résumé, ce code est utilisé pour démarrer l'application Symfony en instanciant le noyau et en fournissant les variables d'environnement appropriées.

### Entity  ###
###### child.php ######


Ce code définit une entité Child dans votre application Symfony. Cette entité est utilisée pour représenter les enfants dans votre système. Voici une explication des différentes parties de ce code :

    La classe Child est annotée avec l'attribut #[ORM\Entity], ce qui indique à Doctrine qu'il s'agit d'une entité persistante et qu'elle doit être associée à une table de base de données.

    La propriété $id est annotée avec #[ORM\Id], #[ORM\GeneratedValue] et #[ORM\Column] pour indiquer qu'il s'agit de la clé primaire de l'entité et qu'elle sera générée automatiquement.

    Les autres propriétés ( $lastname, $firstname, $age, $user ) sont annotées avec #[ORM\Column] pour spécifier le type et les attributs de colonne correspondants dans la table de base de données.

    La propriété $user est annotée avec #[ORM\ManyToOne] pour indiquer qu'il s'agit d'une relation Many-to-One avec l'entité User. Cela signifie qu'un enfant peut appartenir à un seul utilisateur, tandis qu'un utilisateur peut avoir plusieurs enfants.

    La propriété $registration est annotée avec #[ORM\ManyToMany] pour indiquer qu'il s'agit d'une relation Many-to-Many avec l'entité Registration. Cela signifie qu'un enfant peut être inscrit à plusieurs enregistrements, et un enregistrement peut contenir plusieurs enfants.

    La méthode __construct() initialise la collection $registration en tant qu'ArrayCollection vide.

### Menu.php ###


Ce code définit une entité Menu dans votre application Symfony. Cette entité est utilisée pour représenter les menus disponibles dans votre système. Voici une explication des différentes parties de ce code :

    La classe Menu est annotée avec l'attribut #[ORM\Entity], ce qui indique à Doctrine qu'il s'agit d'une entité persistante et qu'elle doit être associée à une table de base de données.

    La propriété $id est annotée avec #[ORM\Id], #[ORM\GeneratedValue] et #[ORM\Column] pour indiquer qu'il s'agit de la clé primaire de l'entité et qu'elle sera générée automatiquement.

    Les autres propriétés ($name, $price) sont annotées avec #[ORM\Column] pour spécifier le type et les attributs de colonne correspondants dans la table de base de données.

    Les méthodes getter et setter sont fournies pour accéder aux propriétés de l'entité.

Cette entité peut être utilisée avec Doctrine pour effectuer des opérations de base de données, telles que la création, la récupération, la mise à jour et la suppression des menus.

### Registration.php ### 


Ce code définit une entité Registration dans votre application Symfony. Cette entité est utilisée pour représenter les enregistrements de repas pour une date donnée. Voici une explication des différentes parties de ce code :

    La classe Registration est annotée avec l'attribut #[ORM\Entity], ce qui indique à Doctrine qu'il s'agit d'une entité persistante et qu'elle doit être associée à une table de base de données.

    La propriété $id est annotée avec #[ORM\Id], #[ORM\GeneratedValue] et #[ORM\Column] pour indiquer qu'il s'agit de la clé primaire de l'entité et qu'elle sera générée automatiquement.

    La propriété $date est annotée avec #[ORM\Column(type: Types::DATE_MUTABLE)] pour indiquer qu'il s'agit d'une colonne de type date dans la base de données. L'attribut Types::DATE_MUTABLE spécifie que la valeur de date peut être modifiée.

    La propriété $children est annotée avec #[ORM\ManyToMany] pour indiquer qu'il s'agit d'une relation many-to-many avec l'entité Child. La relation est configurée pour être bidirectionnelle avec l'entité Child, en utilisant la propriété registration comme propriété inverse.

    Les méthodes addChild et removeChild sont fournies pour ajouter et supprimer des enfants à partir de l'enregistrement. Ces méthodes maintiennent la cohérence bidirectionnelle de la relation en mettant à jour les deux côtés de la relation.

Cette entité peut être utilisée avec Doctrine pour effectuer des opérations de base de données, telles que la création, la récupération, la mise à jour et la suppression des enregistrements de repas.

### User.php ###


Ce code définit une entité User dans votre application Symfony. Cette entité est utilisée pour représenter les utilisateurs de votre système. Voici une explication des différentes parties de ce code :

    La classe User est annotée avec l'attribut #[ORM\Entity], ce qui indique à Doctrine qu'il s'agit d'une entité persistante et qu'elle doit être associée à une table de base de données.

    La propriété $id est annotée avec #[ORM\Id], #[ORM\GeneratedValue] et #[ORM\Column] pour indiquer qu'il s'agit de la clé primaire de l'entité et qu'elle sera générée automatiquement.

    La propriété $email est annotée avec #[ORM\Column(length: 180, unique: true)] pour indiquer qu'il s'agit d'une colonne de type texte dans la base de données et qu'elle doit être unique.

    La propriété $roles est annotée avec #[ORM\Column] pour indiquer qu'il s'agit d'une colonne de type tableau JSON dans la base de données. Cette propriété stocke les rôles de l'utilisateur.

    La propriété $password est annotée avec #[ORM\Column] pour indiquer qu'il s'agit d'une colonne de type texte dans la base de données. Cette propriété stocke le mot de passe haché de l'utilisateur.

    Les méthodes getUserIdentifier, getRoles, getPassword et eraseCredentials sont implémentées en utilisant l'interface UserInterface de Symfony. Ces méthodes sont nécessaires pour l'authentification et la gestion des utilisateurs.

    La propriété $firstname est annotée avec #[ORM\Column(length: 50, nullable: true)] pour indiquer qu'il s'agit d'une colonne de type texte dans la base de données. Cette propriété stocke le prénom de l'utilisateur.
        La propriété $lastname est annotée avec #[ORM\Column(length: 50, nullable: true)] pour indiquer qu'il s'agit d'une colonne de type texte dans la base de données. Cette propriété stocke le nom de famille de l'utilisateur.

    La propriété $child est annotée avec #[ORM\OneToMany] pour indiquer qu'il s'agit d'une relation one-to-many avec l'entité Child. Cette relation est configurée pour être unidirectionnelle, avec la propriété user de l'entité Child comme propriété inverse.

    Les méthodes addChild et removeChild sont fournies pour ajouter et supprimer des enfants associés à l'utilisateur. Ces méthodes maintiennent la cohérence de la relation en mettant à jour les deux côtés de la relation.

    La méthode __toString est implémentée pour renvoyer une représentation sous forme de chaîne de l'utilisateur, en concaténant le prénom et le nom de famille.

Cette entité peut être utilisée avec Doctrine pour effectuer des opérations de base de données, telles que la création, la récupération, la mise à jour et la suppression des utilisateurs.