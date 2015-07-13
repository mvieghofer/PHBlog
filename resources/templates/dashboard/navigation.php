<nav class="dashboardMenu">
    <ul>
        <li><a href='<?php echo Router::getUrl('/'); ?>'>Show Blog</a></li>
        <li><a href="#">Posts</a></li>
        <li><a href="#">Pages</a></li>
        <li><a href='<?php echo Router::getUrl('/logout') ?>'>Logout</a></li>
    </ul>            
</nav>     

<script type="text/javascript">
    $(function() {        
        $("nav.dashboardMenu a").click(function(e) {
            var category = $(e.target).text();
            if (category == "Posts") {
                $("#pages").addClass("dashboard-hidden");
                $("#articles").removeClass("dashboard-hidden");
            } else {
                $("#articles").addClass("dashboard-hidden");
                $("#pages").removeClass("dashboard-hidden");
            }
        });
    });
</script>