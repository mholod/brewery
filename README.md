##Render controller

    {‌{render(controller('App\\Controller\\Controller::method', {'param': 5} ))}}


##Load fixtures:

    bin/console doctrine:fixtures:load


##empty database

    bin/console doctrine:schema:drop -n -q --force --full-database


##Raw query:

    $conn = $entityManager->getConnection();
    
    $sql = 'select * from user where user.id > :id';
    
    $stmt = $con->prepare($sql);
    
    $stmt->execute(['id' => 1]);
    
    $stmt->fetchAll();


##Param converter - injects model into method:



    public function index(User $user) {
    
        return $user
    
    }
    
    composer require sensio/framework-extra-bundle




##Lifecycle callbacks



    Entity: @ORM\HasLifecycleCallbacks()
    
    
    
    @ORM\PrePersist
    
    public function setCreatedAtValue()
    
    {

    $this->createdAt = new \DateTime();


##Refresh database:

    bin/console doctrine:schema:drop -n -q --force --full-database && rm migrations/*.php && bin/console make:migration && bin/console doctrine:migrations:migrate -n -q
    
    
    Cascade delete:
    
    /**
    * @ORM\OneToMany(targetEntity=Expense::class, mappedBy="user", cascade={"remove"}, orphanRemoval=true)
      */
      private $expense;

##Eager loading query in repo:

    public function eagerLoad($id): User
    
    {
    
    return $this->createQueryBuilder('u')
    
    ->innerJoin('u.videos', 'v')
    
    ->addSelect('v')
    
    ->andWhere('u.id = :id')
    
    ->setParameter('id', $id)
    
    ->getQuery()
    
    ->getOneOrNullResult();
    
    }


##Profiler

    composer require web-profiler-bundle
    
    composer require Symfony/debug-bundle


##Required acts as constructor


    <?php
    namespace App\Service;
    trait ExampleServiceTrait
    {
        /**
         * @required 
         */
        public function exampleTraitMethod()
        {
            dump('Congratulations! you are using exampleTraitMethod');
        }
    }
    
    ##Service alias
    
    services.yaml
    
    app.myservices:
    
      class: App\Services\Myservice
    
      public: true
    
    App\Services\MyService: '@app.myservice'
    
    
    
    public function index(ContainerInterface $container) {
    
        $container->get('app.myservice');


##Service list

    bin/console debug:container {service path}


##Cache

    composer require Symfony/cache


##List events

    bin/console debug:event-dispatcher {event name}
    
    
    
    services.yaml
    
    
    
    App\Listeners\VideoCreatedListener:
    
      tags:
    
        - { name: kernel.event_listener, event: video.created.event, method: onVideoCreatedEvent }
    
    
    bin/console doctrine:migrations:diff


##Test data providers


     /** @test
     * @dataProvider provideUrls
     */
    public function responseIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);
     
        $this->assertResponseIsSuccessful();
    }
     
    public function provideUrls()
    {
        return [
            ['/api/expenses'],
            ['/api/expenses/expense/1'],
        ];
    }


##Testing in isolation

    protected $client;
    protected $entityManager;
     
    protected function setUp()
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->client->disableReboot();
     
        $this->entityManager = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $this->entityManager->beginTransaction();
        $this->entityManager->getConnection()->setAutoCommit(false);
    }
 
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->rollback();
        $this->entityManager->close();
        $this->entityManager = null;
    }

##Test code coverage

    install debug
    
    ./bin/phpunit --coverage-text


##Alternative with mocking:

    use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
    use App\Twig\AppExtension;
     
    class CategoryTest extends KernelTestCase
    {
        protected $mockedCategoryTreeFrontPage;
     
        protected function setUp()
        {
            $kernel = self::bootKernel();
            $urlgenerator = $kernel->getContainer()->get('router');
            $this->mockedCategoryTreeFrontPage = $this->getMockBuilder('App\Utils\CategoryTreeFrontPage')
            ->disableOriginalConstructor()
            ->setMethods() // if no, all methods return null unless mocked
            ->getMock();
     
            $this->mockedCategoryTreeFrontPage->urlgenerator = $urlgenerator;
        }

##Testing: Create required dependencies (entity manager, etc)



    use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase
     
    $kernel = self::bootKernel();
    $urlgenerator = $kernel->getContainer()->get('router');
    $entitymanager  =  $kernel->getContainer()->get('doctrine.orm.entity_manager');
    $this->obj = new \App\Utils\MyUtil($entitymanager, $urlgenerator); 
    
    dataprovider test



    <?php
     
    namespace App\Tests\Twig;
     
    use PHPUnit\Framework\TestCase;
    use App\Twig\AppExtension;
     
    class SluggerTest extends TestCase
    {
        /**
         * @dataProvider getSlugs
         */
        public function testSlugify(string $string, string $slug )
        {
            $slugger = new AppExtension;
            $this->assertSame($slug, $slugger->slugify($string));
        }
     
        public function getSlugs()
        {
            yield  ['Lorem Ipsum', 'lorem-ipsum'];
            yield [' Lorem Ipsum', 'lorem-ipsum'];
            yield [' lOrEm  iPsUm  ', 'lorem-ipsum'];
            yield ['!Lorem Ipsum!', 'lorem-ipsum'];
            yield ['lorem-ipsum', 'lorem-ipsum'];
            yield ['Children\'s books', 'childrens-books'];
            yield ['Five star movies', 'five-star-movies'];
            yield ['Adults 60+', 'adults-60'];
     
        }
    }





##Paginator



    composer require knplabs/knp-paginator-bundle



    class VideoRepository extends ServiceEntityRepository
    {
        public function __construct(RegistryInterface $registry, PaginatorInterface $paginator)
        {
            parent::__construct($registry, Video::class);
            $this->paginator = $paginator;
        }
     
        public function findAllPaginated($page)
        {
     
            $dbquery =  $this->createQueryBuilder('v')
            ->getQuery();
     
            $pagination = $this->paginator->paginate($dbquery, $page, 5);
            return $pagination;
        } 
    
    bin/console make:functional-test