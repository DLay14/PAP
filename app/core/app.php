Class App
{
    protected $controller = "home";
    protected $method = "index";
}
public function_construct()
{
    $url = $this->parseURL();
    show($url);
}

private functio parseURL()
{
    $url = isset($_GET['url'])?$_GET['url'] : "home";
    return explode("/", filter_var(trim($url,"/"),FILTER_SANITIZE_url));
}