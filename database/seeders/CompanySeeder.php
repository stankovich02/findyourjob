<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Google',
                'email' => 'official@google.com',
                "password" => Hash::make('google123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'google',
                'website' => 'https://about.google/',
                'phone' => '+1 650-253-0000',
                'description' => 'Google is one of the largest technology companies in the world, focusing on internet search, software services, and technological solutions. It was founded by Larry Page and Sergey Brin in 1998 as part of their research project at Stanford University. Today, Google is part of the broader conglomerate known as Alphabet Inc. The company is best known for its search engine but offers a wide range of other products and services, including Gmail, Google Maps, YouTube, the Android operating system, Google Drive, and many others. Google is also known for its innovation, research in artificial intelligence, and advanced technological projects such as Google Glass and self-driving cars.'
            ],
            [
                'name' => 'sa.global',
                'email' => 'info.rs@saglobal.com',
                "password" => Hash::make('saglobal123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'saglobal',
                'website' => 'https://www.saglobal.com/en-rs/',
                'phone' => '+381 69 3240035',
                'description' => "sa.global empowers organizations and people to achieve more. We do this by bringing our platform expertise into addressing industry challenges through vertical-focused solutions. Our solutions and services are 100% based on Microsoft business applications and the Microsoft Business cloud, and benefit advertising and marketing, accounting, architecture and engineering, consulting, homebuilding, legal, and IT services companies. Through our industry-first approach, we want to put solutions in the hands of people closest to the problem to enable organizations to act faster and make intelligent decisions. Over 800,000 users in 80 countries around the world rely on sa.global's industry-focused expertise to gain value faster, adapt quickly to changes, and build for the future. We have 30+ years of real-world experience, we are an 11-time winner of the Microsoft Dynamics Partner of the Year Award, and have been a part of Microsoft’s elite Inner Circle for 10 years. Our global organization has a 1000-member team across 25 countries. For more information, visit www.saglobal.com."
            ],
            [
                'name' => 'Wiener Städtische',
                'email' => 'office@wiener.co.rs',
                "password" => Hash::make('wiener123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'wienerstadtische',
                'website' => 'https://wiener.co.rs/',
                'phone' => '011 2209 892',
                'description' => 'Wiener Städtische is an insurance company based in Vienna, Austria. It is one of the leading insurance groups in Central and Eastern Europe, offering a wide range of insurance products and services including life insurance, health insurance, property insurance, and liability insurance. The company has a long history dating back to its establishment in 1824 and has since expanded its operations across multiple countries in the region. Wiener Städtische is known for its commitment to customer service, financial stability, and innovation in the insurance industry.'
            ],
            [
                'name' => 'Oracle',
                'email' => 'official@oracle.com',
                "password" => Hash::make('oracle123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'oracle',
                'website' => 'https://www.oracle.com/',
                'phone' => '+1 650-254-0000',
                'description' => 'Oracle Corporation is a multinational technology company headquartered in Redwood City, California, USA. Founded in 1977 by Larry Ellison, Bob Miner, and Ed Oates, Oracle specializes in developing and marketing computer hardware systems and enterprise software products, particularly database management systems. Oracle is best known for its flagship product, the Oracle Database, which is one of the most widely used relational database management systems (RDBMS) in the world. The company offers a comprehensive suite of software and hardware products for businesses, including enterprise resource planning (ERP), customer relationship management (CRM), supply chain management (SCM), and cloud infrastructure services.'
            ],
            [
                'name' => 'DXC Technology',
                'email' => 'investor.relations@dxc.com',
                "password" => Hash::make('dxc123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'dxc',
                'website' => 'http://www.dxc.com',
                'phone' => '+381 11 2055 800',
                'description' => "DXC Technology (NYSE: DXC) helps global companies run their mission-critical systems and operations while modernizing IT, optimizing data architectures, and ensuring security and scalability across public, private and hybrid clouds. The world's largest companies and public sector organizations trust DXC to deploy services to drive new levels of performance, competitiveness, and customer experience across their IT estates."
            ],
            [
                'name' => 'Levi9',
                'email' => 'talent-serbia@levi9.com',
                "password" => Hash::make('levi9123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'levi9',
                'website' => 'https://www.levi9.com/',
                'phone' => '011 4022142',
                'description' => "We’re technology optimists, who believe in the endless possibilities of technology. We have over 18 years of experience as a technology service partner for medium and large size businesses in the Netherlands. We want to make an impact on the world, by making impact on the business of our customer. We’re successful in this, as proven by continuously high customer satisfactions scores. We are uniquely positioned to help organizations with three kinds of offerings. Customer focus as priority - We believe that the impact of technology is achieved by deep understanding of the context and strategy that it’s there to support. This is why as a technology service partner, we’ve chosen to organize for exceptional customer focus. Customer feedback confirms that Levi9 feels more like an extension of your own organization than like an external entity: We are extremely easy to work with and easy to get started with."
            ],
            [
                'name' => 'Vega IT',
                'email' => 'jobs@vegaitglobal.com',
                "password" => Hash::make('vegait123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'vegait',
                'website' => 'http://vegaitglobal.com',
                'phone' => '021 6616557',
                'description' => "Vega IT is a software development partner working at the cutting-edge of digital product development. With our technical expertise, deep-sector knowledge, and relentless passion, we realize your vision. We’ve got more than 750 engineers with technical and domain knowledge, plus all the people it takes to create, ship and maintain a digital product. Sometimes you need a self-managed software engineering team to drive your success. Other times you just need a little extra capacity. We do it all – blending with your team to give you the skills and capability you need to succeed. We take time to learn everything about your business: your dreams, hopes, fears, challenges. And together, we find new and inventive ways to solve the problems you face."
            ],
            [
                'name' => 'Strabag',
                'email' => 'office.rs@strabag.com',
                "password" => Hash::make('strabag123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'strabag',
                'website' => 'https://www.strabag.com',
                'phone' => '+381 11 2221-700',
                'description' => "STRABAG employs about 79,000 people at 700 locations around the world, working on progress. Our projects are characterised by their uniqueness and individual strengths, just like each and every one of us. From building construction and structural engineering, road construction and civil engineering, bridge building and tunnelling, project development, building materials production or facility management – we think ahead, and aim to become the most innovative and sustainable construction technology group in Europe. Equal opportunity, diversity and inclusion are an integral part of who we are as a company and how we operate. Together we work as partners to complete projects successfully and grow with new challenges. Together we achieve great things."
            ],
            [
                'name' => 'IBM',
                'email' => 'official@ibm.com',
                "password" => Hash::make('ibm123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'ibm',
                'website' => 'http://www.ibm.com/',
                'phone' => '+ 381 11 2013 500',
                'description' => "At IBM, we do more than work. We create. We create as technologists, developers, and engineers. We create with our partners. We create with our competitors. If you're searching for ways to make the world work better through technology and infrastructure, software and consulting, then we want to work with you. We're here to help every creator turn their 'what if' into what is. Let's create something that will change everything."
            ],
            [
                'name' => 'Mondi',
                'email' => 'info@mondi.com',
                "password" => Hash::make('mondi123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'mondi',
                'website' => 'https://linktr.ee/mondi_group',
                'phone' => '+43 1 79013-0 ',
                'description' => "Mondi is a global leader in packaging and paper, contributing to a better world by making innovative, packaging and paper solutions that are sustainable by design. Our business is fully integrated across the value chain – from managing forests and producing pulp, paper and plastic films, to developing and manufacturing effective industrial and consumer packaging solutions. Sustainability is at the centre of our strategy and intrinsic in the way we do business. We lead the industry with our customer- centric approach, EcoSolutions, where we ask the right questions to find the most sustainable solution. Mondi has a premium listing on the London Stock Exchange (MNDI), and a secondary listing on the JSE Limited (MNP). Mondi is a FTSE 100 constituent, and has been included in the FTSE4Good Index Series since 2008 and the FTSE/JSE Responsible Investment Index Series since 2007."
            ],
            [
                'name' => 'Microsoft',
                'email' => 'mdcsinfo@microsoft.com',
                "password" => Hash::make('microsoft123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'microsoft',
                'website' => 'https://www.microsoft.com/en-rs/mdcs',
                'phone' => '+381 11 330 6600',
                'description' => "We are growing towards the most innovative Microsoft engineering Campus in Europe composed of high performing teams and extraordinary individuals building cutting edge Microsoft software services and products. Our outcomes power digital transformation of the most strategic WW companies as well as improve lives of every single individual. Our engineers come from most of the WW nations demonstrating the full diversity and inclusion as one of the core Microsoft Values. While we take pride about the quality and values of our people, we are also very proud of the ecosystem we generate around us, making Belgrade as one of the key engineering hubs in this part of the world. By enabling the key desired business outcomes of our customers, we lead and secure the profound business impact to Microsoft Corp."
            ],
            [
                'name' => 'SAP',
                'email' => 'SAPHRSerbia@sap.com',
                "password" => Hash::make('sap123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'sap',
                'website' => 'http://www.sap.com',
                'phone' => '+381 11 3536900',
                'description' => "At SAP, our purpose is to help the world run better and improve people’s lives. Our promise is to innovate to help our customers run at their best. SAP is committed to helping every customer become a best-run business. We engineer solutions to fuel innovation, foster equality, and spread opportunity across borders and cultures. Together, with our customers and partners, we can transform industries, grow economies, lift up societies, and sustain our environment."
            ],
            [
                'name' => 'TelQ',
                'email' => 'hr@telqtele.com',
                "password" => Hash::make('telq' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'telq',
                'website' => 'https://telqtele.com/',
                'phone' => '+381 11 5154100',
                'description' => "TelQ Telecom is a worldwide provider of SMS quality assurance services. As a cloud-based SaaS telecom platform, we are enabling customers all over the world to check and improve the quality of their telecom communication channels. Through the widest network of testing devices (15k+) in the industry, we have so far handled over ten million test results. We collaborate with major mobile network operators in Europe and Asia, as well as leading SMS service providers. We provide testing coverage for over 1400 networks worldwide, covering over 180 countries."
            ],
            [
                'name' => 'Quantox Technology',
                'email' => 'hr@quantox.com',
                "password" => Hash::make('quantox123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'quantox',
                'website' => 'https://quantox.com/',
                'phone' => '+38162667533',
                'description' => "At Quantox, we grasp the challenge, target the essence and make it possible. Awarded by Ernst & Young 'Fast Growing Entrepreneur' in Serbia for 2021. Our passion and expansion are guided by the idea of bringing together IT and business knowledge around one goal - creating top-notch software solutions and digital experiences that create meaningful and measurable value for our clients and users. Entering the second decade of our work with more than 160+ successful projects behind us and 500+ people on board, we cherish our milestones and constantly strive to break new ground in the world of digital. By developing creative, high-quality software solutions and providing unique digital experiences, we support brands around the world to stand out digitally and accelerate their business. Working with leading technologies, company offer within sectors like E-Commerce and Digital Entertainment, a wide range of positions and constantly look for diverse professional profiles."
            ],
            [
                'name' => 'RT-RK',
                'email' => 'career-srb@rt-rk.com',
                "password" => Hash::make('rtrk123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'rtrk',
                'website' => 'http://www.rt-rk.com',
                'phone' => '+381 21 4801100',
                'description' => "RT-RK is a premium embedded software development house in the Southeast Europe, with a focus on consumer electronics and infotainment systems. The company was founded in 1991, and currently employs 500+ engineers. RT-RK has a background in being a near shore development center of silicon vendor, networking, automotive, and consumer electronics companies. RT-RK operates under the umbrella of TTTech Group."
            ],
            [
                'name' => 'Netcare',
                'email' => 'career@netcare.com',
                "password" => Hash::make('netcare123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'netcare',
                'website' => 'https://www.netcare.de/en/home/',
                'phone' => '+381 800 300141',
                'description' => "Here at netcare you whole-heartedly can judge the inside from the outside. Our 350 light-flooded m2 above the roofs of Leinfelden for example are as open and transparent as our way of working. Here crystal-clear and sharply-contoured solutions are formed which have far-reaching implications for the digital everyday life of our customers not just locally in Stuttgart, Frankfurt and Berlin but worldwide. With more than 80 co-workers, we find solutions for some of the most prestigious corporations in the world, and firms like us, contenders who want to get there. We are at your service at our venues in Neustetten, Leinfelden-Echterdingen (Stuttgart), Frankfurt, Berlin, Belgrade/Serbia and Tennessee/USA."
            ],
            [
                'name' => 'CAKE.com',
                'email' => 'jobs@coi.ng',
                "password" => Hash::make('cake123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'cake',
                'website' => 'https://cake.com',
                'phone' => '021 3001350',
                'description' => "We design our software to fit the needs of modern teams. The best work happens when you empower teams to be result-oriented, open to discussion, and accountable. That is why we have created products that are intuitively simple to use yet robust enough to allow flexibility and efficiency no matter the task. Clockify, Pumble, and Plaky work great together but also excel individually. With cake.com's work management software suite, you can do everything — from scheduling work and collaborating with your team to tracking costs and building powerful reports."
            ],
            [
                'name' => '30Hills',
                'email' => 'hello@30hills.com',
                "password" => Hash::make('30hills123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => '30hills',
                'website' => 'https://30hills.com/',
                'description' => "Inspiring businesses to bring innovative, stunning ideas to life. 30Hills is a digital incubator and solution provider focused on implementing customized and innovative solutions for startups and corporations. Our expertise is in managing the process of innovation through product development and application of Agile and Design Thinking methodologies. Our team has created the environment in which we help our clients in the process of ideating, designing, and building digital solutions that address current and upcoming business needs. 30Hills has a large number of local and international startup and corporate clients. These clients come from various industries such as banking, retail, sport, procurement, construction, oil, gaming, education, etc. Therefore, the firm’s job is to digitize those companies and industries by creating products that make a change, achieve results and maximize business potential."
            ],
            [
                'name' => 'Ubisoft',
                'email' => 'official@ubisoft.com',
                "password" => Hash::make('ubisoft123' . env('CUSTOM_STRING_FOR_HASH')),
                'logo' => 'ubisoft',
                'website' => 'http://www.ubisoftgroup.com',
                'description' => "Ubisoft’s 21,000 team members, working across more than 30 countries around the world, are bound by a common mission to enrich players’ lives with original and memorable gaming experiences. Their commitment and talent have brought to life many acclaimed franchises such as Assassin’s Creed, Far Cry, Watch Dogs, Just Dance, Rainbow Six, and many more to come.  Ubisoft is an equal opportunity employer that believes diverse backgrounds and perspectives are key to creating worlds where both players and teams can thrive and express themselves. If you are excited about solving game changing challenges, cutting edge technologies and pushing the boundaries of entertainment, we invite you to join our journey and help us Create the unknown."
            ]
        ];
        foreach ($companies as $company) {
            $company["created_at"] = now();
            \App\Models\Company::create($company);
        }
    }
}
