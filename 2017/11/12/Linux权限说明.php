<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  
  <title>linux权限说明 | 我自己的运维笔记</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <meta name="keywords" content="权限" />
  
  
  
  
  <meta name="description" content="大致了解了Linux的使用者与群组之后，接着下来，我们要来谈一谈， 这个文件的权限要如何针对这些所谓的『使用者』与『群组』来设定呢？ 这个部分是相当重要的，尤其对于初学者来说，因为文件的权限与属性是学习Linux的一个相当重要的关卡， 如果没有这部份的概念，那么你将老是听不懂别人在讲什么呢！尤其是当你在你的屏幕前面出现了『Permission deny』的时候，不要担心，『肯定是权限设定错误』啦！">
<meta name="keywords" content="权限">
<meta property="og:type" content="article">
<meta property="og:title" content="Linux权限说明">
<meta property="og:url" content="http://hexo.idwuhan.com/2017/11/12/Linux权限说明.php">
<meta property="og:site_name" content="我自己的运维笔记">
<meta property="og:description" content="大致了解了Linux的使用者与群组之后，接着下来，我们要来谈一谈， 这个文件的权限要如何针对这些所谓的『使用者』与『群组』来设定呢？ 这个部分是相当重要的，尤其对于初学者来说，因为文件的权限与属性是学习Linux的一个相当重要的关卡， 如果没有这部份的概念，那么你将老是听不懂别人在讲什么呢！尤其是当你在你的屏幕前面出现了『Permission deny』的时候，不要担心，『肯定是权限设定错误』啦！">
<meta property="og:locale" content="zh-CN">
<meta property="og:updated_time" content="2018-03-02T06:04:18.160Z">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="Linux权限说明">
<meta name="twitter:description" content="大致了解了Linux的使用者与群组之后，接着下来，我们要来谈一谈， 这个文件的权限要如何针对这些所谓的『使用者』与『群组』来设定呢？ 这个部分是相当重要的，尤其对于初学者来说，因为文件的权限与属性是学习Linux的一个相当重要的关卡， 如果没有这部份的概念，那么你将老是听不懂别人在讲什么呢！尤其是当你在你的屏幕前面出现了『Permission deny』的时候，不要担心，『肯定是权限设定错误』啦！">
  
  <link rel="icon" href="/css/images/favicon.ico">
  
    <link href="//fonts.googleapis.com/css?family=Source+Code+Pro" rel="stylesheet" type="text/css">
  
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Montserrat:700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic" rel="stylesheet" type="text/css">
  <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
  <style type="text/css">
    @font-face{font-family:futura-pt;src:url(https://use.typekit.net/af/9749f0/00000000000000000001008f/27/l?subset_id=2&fvd=n5) format("woff2");font-weight:500;font-style:normal;}
    @font-face{font-family:futura-pt;src:url(https://use.typekit.net/af/90cf9f/000000000000000000010091/27/l?subset_id=2&fvd=n7) format("woff2");font-weight:500;font-style:normal;}
    @font-face{font-family:futura-pt;src:url(https://use.typekit.net/af/8a5494/000000000000000000013365/27/l?subset_id=2&fvd=n4) format("woff2");font-weight:lighter;font-style:normal;}
    @font-face{font-family:futura-pt;src:url(https://use.typekit.net/af/d337d8/000000000000000000010095/27/l?subset_id=2&fvd=i4) format("woff2");font-weight:400;font-style:italic;}</style>
    
  <link rel="stylesheet" id="athemes-headings-fonts-css" href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz%3A200%2C300%2C400%2C700&amp;ver=4.6.1" type="text/css" media="all">
  <link rel="stylesheet" href="/css/style.css">

  <script src="/js/jquery-3.1.1.min.js"></script>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="/css/bootstrap.css" >
  <link rel="stylesheet" href="/css/hiero.css" >
  <link rel="stylesheet" href="/css/glyphs.css" >
  
    <link rel="stylesheet" href="/css/vdonate.css" >
  

</head>

<script>
var themeMenus = {};

  themeMenus["/"] = "首页"; 

  themeMenus["/archives"] = "归档"; 

  themeMenus["/categories"] = "分类"; 

  themeMenus["/tags"] = "标签"; 

  themeMenus["/about"] = "关于"; 

  themeMenus["/atom.xml"] = "订阅"; 

</script>


  <body data-spy="scroll" data-target="#toc" data-offset="50">


  <header id="allheader" class="site-header" role="banner">
  <div class="clearfix container">
      <div class="site-branding">

          <h1 class="site-title">
            
              <a href="/" title="我自己的运维笔记" rel="home"> 我自己的运维笔记 </a>
            
          </h1>

          
            <div class="site-description">Life doesn&#39;t backup, not reboot, but only shutdown!</div>
          
            
          <nav id="main-navigation" class="main-navigation" role="navigation">
            <a class="nav-open">Menu</a>
            <a class="nav-close">Close</a>
            <div class="clearfix sf-menu">

              <ul id="main-nav" class="nmenu sf-js-enabled">
                    
                      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-1663"> <a class="" href="/">首页</a> </li>
                    
                      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-1663"> <a class="" href="/archives">归档</a> </li>
                    
                      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-1663"> <a class="" href="/categories">分类</a> </li>
                    
                      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-1663"> <a class="" href="/tags">标签</a> </li>
                    
                      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-1663"> <a class="" href="/about">关于</a> </li>
                    
                      <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-1663"> <a class="" href="/atom.xml">订阅</a> </li>
                    
              </ul>
            </div>
          </nav>


      </div>
  </div>
</header>




  <div id="container">
    <div id="wrap">
            
      <div id="content" class="outer">
        
          <section id="main" style="float:none;"><article id="post-Linux权限说明" style="width: 66%; float:left;" class="article article-type-post" itemscope itemprop="blogPost" >
  <div id="articleInner" class="clearfix post-1016 post type-post status-publish format-standard has-post-thumbnail hentry category-template-2 category-uncategorized tag-codex tag-edge-case tag-featured-image tag-image tag-template">
    
    
      <header class="article-header">
        
  
    <h1 class="thumb" class="article-title" itemprop="name">
      Linux权限说明
    </h1>
  

      </header>
    
    <div class="article-meta">
      
	Posted on <a href="/2017/11/12/Linux权限说明.php" class="article-date">
	  <time datetime="2017-11-12T07:02:00.000Z" itemprop="datePublished">十一月 12, 2017</time>
	</a>

      
	<span id="busuanzi_container_page_pv">
	  本文总阅读量<span id="busuanzi_value_page_pv"></span>次
	</span>

    </div>
    <div class="article-entry" itemprop="articleBody">
      
        <p>大致了解了Linux的使用者与群组之后，接着下来，我们要来谈一谈， 这个文件的权限要如何针对这些所谓的『使用者』与『群组』来设定呢？ 这个部分是相当重要的，尤其对于初学者来说，因为文件的权限与属性是学习Linux的一个相当重要的关卡， 如果没有这部份的概念，那么你将老是听不懂别人在讲什么呢！尤其是当你在你的屏幕前面出现了『Permission deny』的时候，不要担心，『肯定是权限设定错误』啦！呵呵！好了，闲话不多聊，赶快来瞧一瞧先。</p>
<a id="more"></a>
<h2 id="基本权限"><a href="#基本权限" class="headerlink" title="基本权限"></a>基本权限</h2><pre><code>a. 读 (r/4)  
 文件：允许用户打开文件，读取文件内容  
 目录：允许用户列出目录内容         
b. 写 (w/2)  
 文件：允许用户修改文件内容  
 目录：允许用户在目录中创建/删除子对象  
c. 执行(x/1)  
 文件：允许用户运行文件  
 目录：允许用户进入目录  
</code></pre><h2 id="特殊权限"><a href="#特殊权限" class="headerlink" title="特殊权限"></a>特殊权限</h2><pre><code>a. suid (u+s/4)  
 应用于可执行文件，设置使文件在执行过程中具备文件所有者的权限  
b. sgid (g+s/2)  
 应用于目录或可执行文件，应用于目录时，设置目录下所有文件或子目录为目录的所有组，应用于可执行文件时，设置使文件在执行过程中具备文件所有组的权限   
c. 粘着位 (o+t/1)  
应用于目录，设置目录下所有子目录或文件，只有root和文件所有者能删除
</code></pre>
      
    </div>
    <footer class="entry-meta entry-footer">
      
	<span class="ico-folder"></span>
    <a class="article-category-link" href="/categories/Linux/">Linux</a>

      
  <span class="ico-tags"></span>
  <ul class="article-tag-list"><li class="article-tag-list-item"><a class="article-tag-list-link" href="/tags/权限/">权限</a></li></ul>

      
        <div id="donation_div"></div>

<script src="/js/vdonate.js"></script>
<script>
var a = new Donate({
  title: '如果觉得我的文章对您有用，请随意打赏。您的支持将鼓励我继续创作!', // 可选参数，打赏标题
  btnText: '打赏支持', // 可选参数，打赏按钮文字
  el: document.getElementById('donation_div'),
  wechatImage: 'https://raw.githubusercontent.com/ask6412/ask6412.github.io/master/images/Wechat.jpg',
  alipayImage: 'https://raw.githubusercontent.com/ask6412/ask6412.github.io/master/images/Alipay.jpg'
});
</script>
      
            
      
        
	<div id="comment">
		<!-- 来必力City版安装代码 -->
		<div id="lv-container" data-id="city" data-uid="MTAyMC8zMTc2Ni84MzMw">
		<script type="text/javascript">
		   (function(d, s) {
		       var j, e = d.getElementsByTagName(s)[0];

		       if (typeof LivereTower === 'function') { return; }

		       j = d.createElement(s);
		       j.src = 'https://cdn-city.livere.com/js/embed.dist.js';
		       j.async = true;

		       e.parentNode.insertBefore(j, e);
		   })(document, 'script');
		</script>
		<noscript>为正常使用来必力评论功能请激活JavaScript</noscript>
		</div>
		<!-- City版安装代码已完成 -->
	</div>


      
    </footer>
  </div>
  
    
<nav id="article-nav">
  
  
    <a href="/2017/11/02/Teampass 密码管理系统配置部署.php" id="article-nav-older" class="article-nav-link-wrap">
      <strong class="article-nav-caption">下一篇</strong>
      <div class="article-nav-title">Teampass 密码管理系统配置部署</div>
    </a>
  
</nav>

  
</article>

<!-- Table of Contents -->

  <aside id="sidebar">
    <div id="toc" class="toc-article">
    <strong class="toc-title">文章目录</strong>
    
      <ol class="nav"><li class="nav-item nav-level-2"><a class="nav-link" href="#基本权限"><span class="nav-number">1.</span> <span class="nav-text">基本权限</span></a></li><li class="nav-item nav-level-2"><a class="nav-link" href="#特殊权限"><span class="nav-number">2.</span> <span class="nav-text">特殊权限</span></a></li></ol>
    
    </div>
  </aside>

</section>
        
      </div>
      <footer id="footer" class="site-footer">
  

  <div class="clearfix container">
      <div class="site-info">
	      &copy; 2018 我自己 All Rights Reserved.
          
            <span id="busuanzi_container_site_uv">
              <br>访客数<span id="busuanzi_value_site_uv"></span>人&nbsp;&nbsp;
              访问量<span id="busuanzi_value_site_pv"></span>次</br>
            </span>
          
      </div>
  </div>
</footer>


<!-- min height -->

<script>
    var contentdiv = document.getElementById("content");

    contentdiv.style.minHeight = document.body.offsetHeight - document.getElementById("allheader").offsetHeight - document.getElementById("footer").offsetHeight + "px";
</script>

    </div>
    <!-- <nav id="mobile-nav">
  
    <a href="/" class="mobile-nav-link">Home</a>
  
    <a href="/archives" class="mobile-nav-link">Archives</a>
  
    <a href="/categories" class="mobile-nav-link">Categories</a>
  
    <a href="/tags" class="mobile-nav-link">Tags</a>
  
    <a href="/about" class="mobile-nav-link">About</a>
  
    <a href="/atom.xml" class="mobile-nav-link">rss</a>
  
</nav> -->
    

<!-- mathjax config similar to math.stackexchange -->

<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    tex2jax: {
      inlineMath: [ ['$','$'], ["\\(","\\)"] ],
      processEscapes: true
    }
  });
</script>

<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {
        skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code']
      }
    });
</script>

<script type="text/x-mathjax-config">
    MathJax.Hub.Queue(function() {
        var all = MathJax.Hub.getAllJax(), i;
        for(i=0; i < all.length; i += 1) {
            all[i].SourceElement().parentNode.className += ' has-jax';
        }
    });
</script>

<script type="text/javascript" src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>


  <link rel="stylesheet" href="/fancybox/jquery.fancybox.css">
  <script src="/fancybox/jquery.fancybox.pack.js"></script>


<script src="/js/scripts.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/main.js"></script>







  <div style="display: none;">
    <script src="https://s95.cnzz.com/z_stat.php?id=1260716016&web_id=1260716016" language="JavaScript"></script>
  </div>



	<script async src="//dn-lbstatics.qbox.me/busuanzi/2.3/busuanzi.pure.mini.js">
	</script>






  </div>

  <a id="rocket" href="#top" class=""></a>
  <script type="text/javascript" src="/js/totop.js" async=""></script>
</body>
</html>
