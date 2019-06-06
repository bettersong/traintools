<?php //这是测试的控制器，可以删除。
class ReviewController extends Controller
{
    // 首页方法，测试框架自定义DB查询queryString
    public function index()
    {
        $mysqlModel = new Model("review");
        $Workreview = $mysqlModel ->selectAll();
        $this->assign('Workreview', $Workreview);
    }
}