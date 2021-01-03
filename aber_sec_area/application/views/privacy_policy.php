<!doctype html>
<html lang=en-US>
<head>
<?php $this->load->view('inc_header_commoncss');?>
</head>
<body>    
    <?php $this->load->view('inc_header_menu');?>   

    
        <div class="blank-div-section"></div>
        <div class="trans-menu-join-bg">
            <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img" />
        </div>  
        <div class="trans-banner-section trans-select-category-banner">
            <div class="trans-blank-section"></div>
            <div class="container">
                <div class="trans-banner-section-content">
                    <div class="trans-banner-content-line"></div>
                    <div class="trans-select-category-head">
                        Privacy Policy
                    </div>                
                </div>
            </div> 
            <div class="trans-caet-banner-bottom-img"></div>      
        </div> 
        <div class="container">
            <div class="trans-privacy">
                <h2> <?php echo $this->common->getDbValue(trim($cms_data_11['cms_title']))?></h2>
                
                <?php echo $this->common->getDbValue(trim($cms_data_11['cms_desc']))?>
                    Privacy is not a new concept. Humans have always desired privacy in their social as well as private lives. But the idea of privacy as a human right is a relatively modern phenomenon.
                    <br><br>
                    Around the world, laws and regulations have been developed for the protection of data related to government, education, health, children, consumers, financial institutions, etc.
                    <br><br>
                    This data is critical to the person it belongs to. Data privacy and security binds individuals and industries together and runs complex systems in our society. From credit card numbers and social security numbers to email addresses and phone numbers, our sensitive, personally identifiable information is important. This sort of information in unreliable hands can potentially have far-reaching consequences.
                    <br><br>
                    Companies or websites that handle customer information are required to publish their Privacy Policies on their business websites. If you own a website, web app, mobile app or desktop app that collects or processes user data, you most certainly will have to post a Privacy Policy on your website (or give in-app access to the full Privacy Policy agreement).
                    <br><br>
                    There are several reasons for a website to post its Privacy Policy agreement on its website.
                    <br><br>
                    Here are some of the main reasons:

                    Required by the law
                    Required by third party services
                    Increases Transparency
                    Let's take a look at each of these reasons in more depth.<br><br><br>

                    <h2> Privacy Policy is Required by the Law</h2>
                    <br>
                    For individuals to feel comfortable sharing their personal information on the internet, there should be some sort of legal responsibility on businesses to protect that data and keep the users informed about the status and health of their information.
                    <br><br>
                    Countries around the world have realized the need to protect their citizens' data and privacy. Businesses and websites that collect and/or process customer information are required to publish and abide by a Privacy Policy agreement.
                    <br><br>
                    A majority of countries have already enacted laws to protect their users' data security and privacy. These laws require businesses to obtain explicit consent from users whose data they will store or process.
                    <br><br>
                    A few of these laws include the following:
                    <br><br>
                    CalOPPA in the USA<br>
                    GDPR in the EU<br>
                    PIPEDA in Canada<br>
                    For a business or a website that collects and processes user information in a certain region or country, it is very important to have complete knowledge of the data and privacy protection laws enforced in that region and the region your customers and end users are in. Non-compliance with these laws can result in hefty fines or even prosecution against the violator.
            </div>    
        </div>

    <?php $this->load->view('inc_footer');?>  
    <?php $this->load->view('inc_common_footer_js');?>     
    
    
</body>