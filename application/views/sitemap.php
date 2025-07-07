<?php header('Content-type: text/xml'); ?>
<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc><?php echo base_url();?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>
    </url>
    
    <url>
        <loc><?php echo base_url()."exchanges";?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>
    </url>
    
    <url>
        <loc><?php echo base_url()."top-gainer-coins";?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>
    </url>
    
    <url>
        <loc><?php echo base_url()."top-loser-coins";?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>
    </url>
    
    <url>
        <loc><?php echo base_url()."calculator";?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>
    </url>
    
    <url>
        <loc><?php echo base_url()."news";?></loc>
        <priority>1.0</priority>
        <changefreq>hourly</changefreq>
    </url>

 <?php foreach ($coinHomeData as $res) { ?>
    <url>
        <loc>
        <?php echo base_url()."coin/".$res->id ?></loc>
        <changefreq>hourly</changefreq>
        <priority>1.0</priority>
        </url>;
<?php } ?>

 <?php foreach ($coinExchangeData as $res) { ?>
    <url>
        <loc>
        <?php echo base_url()."exchange/".$res->id ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
        </url>;
<?php } ?>
</urlset>