<?php
require './bootstrap.php';

$config = new Zend_Config_Ini(CONFIG_PATH, ENV);
$couch = new Couch_Client($config->db->dsn, $config->db->name);

$report = new Models_Report($couch, $_GET['id']);
$res = $report->fetch();

// handle missing IDs more intelligently later
if (!$res){ header('Location: ../'); }



?><html>
<head>
    <title>Total Impact: <?php echo $report->getBestIdentifier() ?></title>
    <link rel="stylesheet" type="text/css" href="ui/totalimpact.css" />
    <script type="text/javascript" src="ui/jquery/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="ui/jquery/jquery.tools.min.js"></script>
    <script type="text/javascript" src="ui/protovis-3.2/protovis-r3.2.js"></script>

	<script type="text/javascript">
	//Google Analytics code

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-23384030-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>

</head>
<body>
    <div id="header">
		<a href="./"><img src="./ui/img/logo.png" alt="Total-Impact" width='200px' border=0/></a>
    </div>

    <div id="report">
        <h2>Impact report for <?php echo $report->getBestIdentifier(); ?></h2>
        <div id="report-meta">
            <p>Created <span class="created-at"><?php echo $report->getCreatedAt('j M, Y');?></span>
                with <span class="artifacts-count"><?php echo $report->getArtifactsCount(); ?></span>
                research artifacts. <p>Stable url: <a href"./"><?php echo "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']; ?></a></p>  

        </div>
        <div id="metrics">
            <?php
                $text = $report->render();
				echo "$text";
            ?>
        </div>
    </div>
    <!-- 2011-05-12 ADDED by Aliaksandr Birukou-->
<div id="footer" class="section">
    <h3>Metrics are computed based on the following data sources:</h3>

    <ul type="square" class="body">
    <li>
    <a href="http://www.CrossRef.org/"><img src="http://www.CrossRef.org/favicon.ico" border='0'>CrossRef</a> - an official Digital Object Identifier (DOI) Registration Agency of the International DOI Foundation. 
    <br>For a <strong>DOI</strong> it returns: 
    <ul>
            <li><strong><span class="param">journal</span></strong>: <span class="desc">the journal, where the paper is published,</span></li>
            <li><strong><span class="param">date</span></strong>: <span class="desc">the date of the publication,</span></li> 
            <li><strong><span class="param">title</span></strong>: <span class="desc">the title of the publication.</span></li>
    </ul></li>
    </ul>
    <ul type="square" class="body">
    <li>
    <a href="http://datadryad.org/"><img src="http://dryad.googlecode.com/svn-history/r4402/trunk/dryad/dspace/modules/xmlui/src/main/webapp/themes/Dryad/images/favicon.ico" border='0'>Dryad</a> - an international repository of data underlying peer-reviewed articles in the basic and applied biosciences. <br>For a <strong>DOI</strong> to a data package in Dryad, it returns:
    <ul>
            <li><strong><span class="param">page views</span></strong>: <span class="desc">the number of views of the item by Dryad users.</span></li>
    </ul></li>
    </ul>
    <ul type="square" class="body">
    <li>
    <a href="http://www.facebook.com/"><img src="http://www.facebook.com/favicon.ico" border='0'>Facebook</a> - a social networking service. 
    <br>For a <strong>DOI</strong> it returns: 
       <ul>
            <li><strong><span class="param">likes</span></strong>: <span class="desc">the number of users who liked the article,</span></li>
            <li><strong><span class="param">shares</span></strong>: <span class="desc">the number of users who shared the article,</span></li>
            <li><strong><span class="param">comments</span></strong>: <span class="desc">the number of users who commented on the article,</span></li>
            <li><strong><span class="param">clicks</span></strong>: <span class="desc">the number of users who clicked on the article.</span></li>
    </ul></li>
    </ul>
    <ul type="square" class="body">
    <li>
    <a href="http://www.icpsr.umich.edu/icpsrweb/ICPSR/"><img src="http://www.icpsr.umich.edu/favicon.ico" border='0'>Inter-University Consortium for Political and Social Research (ICPSR)</a> - an organization that provides access to an extensive collection of downloadable data.
    <br>For a <strong>DOI</strong> to a dataset in ICPSR, it returns: 
    <ul>
            <li><strong><span class="param">related_refs</span></strong>: <span class="desc">number of related articles, as collected by ICPSR.</span></li>
    </ul></li>
    </ul>
    <ul type="square" class="body">
    <li>
    <a href="http://www.Mendeley.com/"><img src="http://www.Mendeley.com/favicon.ico" border='0'>Mendeley</a> - a research management tool for desktop and web.
    <br>For a <strong>DOI</strong> it returns:
    <ul>
            <li><strong><span class="param">readers</span></strong>: <span class="desc">the number of readers of the article,</span></li>
            <li><strong><span class="param">groups</span></strong>: <span class="desc">the number of groups of the article,</span></li>
    </ul></li>
    </ul>
    <ul type="square" class="body">
    <li>
    <a href="http://www.plos.org/"><img src="http://www.plosbiology.org/images/favicon.ico" border='0'>PLoS</a> - nonprofit publisher of open access articles in science and medicine.
    <br>For a <strong>DOI</strong> to an article published in PLoS, it returns:
    <ul>
            <li><strong><span class="param">readers</span></strong>: <span class="desc">the number of downloads of the PLoS article,</span></li>
    </ul></li>
    </ul>
    <ul type="square" class="body">
    <li>
    <a href="http://www.slideshare.net/"><img src="http://www.slideshare.net/favicon.ico" border='0'>Slideshare</a> - the best way to share presentations, documents and professional videos. 
    <br>For an <strong>URL</strong> to a slide presentation, it returns:
    <ul>
            <li><strong><span class="param">downloads</span></strong>: <span class="desc">the number of downloads of the presentation,</span></li>
            <li><strong><span class="param">favorites</span></strong>: <span class="desc">the number of users who added the presentation in their favorites,</span></li>
            <li><strong><span class="param">comments</span></strong>: <span class="desc">the number of comments on the presentation,</span></li>
            <li><strong><span class="param">views</span></strong>: <span class="desc">the number of views of the presentation.</span></li>
    </ul></li>
    </ul>

In this initial release, a snapshot of the impact data is captured the first time an url is displayed. In the future we are planning to periodically refresh the impact values.


</div><!-- END OF ADDED by Aliaksandr Birukou-->

</body>
</html>
