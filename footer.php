        <div id="footer">
            <div class="wrapper">
                <div id="twitterfeed" class="footercol">

                    <!--<h2 class="grey" id="recent">Recent reports</h2>-->
                    <!-- https://twitter.com/about/resources/widgets/widget_search -->

                    <script src="http://widgets.twimg.com/j/2/widget.js"></script>
                    <script>
                        new TWTR.Widget({
                            version: 2,
                            type: 'search',
                            search: 'via @mytotalImpact',
                            interval: 30000,
                            subject: 'Latest tweeted reports:',
                            width: "100%",
                            height: 250,
                            theme: {
                                shell: {
                                    background: '#eee',
                                    color: '#000'
                                },
                                tweets: {
                                    background: '#eee',
                                    color: '#000',
                                    links: '#933'
                                }
                            },
                            features: {
                                scrollbar: false,
                                loop: false,
                                live: true,
                                hashtags: true,
                                timestamp: true,
                                avatars: true,
                                toptweets: true,
                                behavior: 'all'
                            }
                        }).render().start();
                    </script>
                </div>
                <div class="recent-changes footercol">
                    <h4>Latest changes on <a href="https://github.com/mhahnel/Total-Impact/blob/master/CHANGES.md">GitHub</a></h4>
                    <?php
                    include_once "library/PHPMarkdownExtra1.2.4/markdown.php";
                    $fh = @fopen("CHANGES.md", "r");

                    $lines = "";
                    for ($i = 0; $i < 5; $i++) {
                        echo Markdown(fgets($fh));
#echo fgets($fh);
#echo $i;
                    }
#@fclose($fh);
#$my_html = Markdown($lines);
#echo $my_html;
                    ?>


                </div>
                <div class="altmetrics footercol">

                    an <a class="img" href="http://altmetrics.org" title="an altmetrics project"><img src="./ui/img/altmetrics_logo.png" alt="altmetrics" width="80"/></a> project.<br/>
                </div>
            </div>
        </div> <!-- end footer -->