<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    private $jobs = [
        [
            //Strabag - Skills: intermidiate
            'name' => 'System Engineer',
            'description' => '<h4>In this position you will:</h4><ul><li>Participate and/or lead projects in line with our project methodology</li><li>Work on datacenters system implementation, outsourcing and customer support projects to Ensures the highest level of systems and infrastructure availability</li><li>Conduct in installations, configures and tests operating systems, virtualization software and system management tools.</li><li>Implement warranty and support activities provided either by on-site and/or remote troubleshooting and support services under SLA</li><li>Constantly keep up-to-date and improve knowledge to the highest level. Achieve partners’ certificates for demanding expertise and according to IT vendor standards</li><li>Lead user courses and conduct mentoring when needed</li><li>Install, configure, and test operating systems, application software, and system management tools.</li></ul>',
            'responsibilities' => '<ul><li>Experience related to installation, configuration, and maintenance of Server OS</li><li>Experience in backup and archiving systems: installation, configuration, and maintenance</li><li>Experience in virtualization technologies: installation, configuration, and maintenance</li><li>Preferred experience in Server OS clusters: installation, configuration, and maintenance</li><li>Experience in database systems administration: installation, configuration, and maintenance will be considered as advantage</li></ul>',
            'requirements' => '<ul><li>University degree, preferably School of Electrical engineering or similar</li><li>Current technical certificates</li><li>Fluency in English language (spoken and written)</li><li>Driving License B category</li></ul>',
            'benefits' => '<ul><li>Working on challenging and complex projects</li><li>Strong opportunities for professional growth, by enhancing skills through extensive training, participation in huge innovative projects and generally by taking on new tasks in order to develop the employees</li><li>Financial stability, continuous growth, and business success</li></ul>',
            'category_id' => 2,
            'city_id' => 20,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 1,
            'company_id' => 8,
            'application_deadline' => '2024-04-01',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Google - linux, unix, c++, c , senior
            'name' => 'Senior C++ Developer',
            'description' => '<h4>In this position you will:</h4>
                <ul>
                    <li>Lead and contribute to the development of complex software systems using C++</li>
                    <li>Collaborate with cross-functional teams to design, develop, and deliver high-quality software solutions</li>
                    <li>Participate in code reviews and provide constructive feedback to team members</li>
                    <li>Optimize software performance and ensure scalability and reliability</li>
                    <li>Stay up-to-date with the latest technologies and industry trends</li>
                    <li>Mentor junior developers and share best practices</li>
                </ul>',
            'responsibilities' =>
                '<ul>
                    <li>Design and implement efficient and reusable C++ code</li>
                    <li>Debug and resolve technical issues</li><li>Write unit tests and perform code coverage analysis</li>
                    <li>Collaborate with product managers and stakeholders to define project requirements</li>
                    <li>Contribute to architectural design and technical documentation</li>
                </ul>',
            'requirements' =>
                '<ul>
                    <li>Bachelor’s or Master’s degree in Computer Science or related field</li>
                    <li>Extensive experience in C++ development, preferably in a senior role</li>
                    <li>Strong understanding of software design principles and patterns</li>
                    <li>Experience with multi-threading, networking, and performance optimization</li>
                    <li>Excellent problem-solving and analytical skills</li>
                    <li>Ability to work effectively in a fast-paced and collaborative environment</li>
                </ul>',
            'benefits' => '<ul>
                    <li>Competitive salary and comprehensive benefits package</li>
                    <li>Opportunity to work on cutting-edge projects with top talent in the industry</li>
                    <li>Access to Google’s state-of-the-art facilities and resources</li>
                    <li>Continuous learning and professional development opportunities</li>
                    <li>Dynamic and inclusive work culture that values diversity and innovation</li>
                </ul>',
            'category_id' => 1,
            'city_id' => 1,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 1,
            'salary' => 5000,
            'application_deadline' => '2024-03-25',
            'status' => Job::STATUS_ACTIVE
        ],
        [//SAP - ios , andorid,typescript, cloud, agile,react native, intermediate
            'name' => 'Mobile App Developer',
            'description' => '<p>Join SAP, a global leader in enterprise software solutions, and help shape the future of mobile applications. As a Mobile App Developer, you will be at the forefront of innovation, designing and developing cutting-edge mobile solutions that empower businesses and drive digital transformation.</p>',
            'responsibilities' => '<p>As a Mobile App Developer at SAP, you will:</p>
        <ul>
            <li>Design and develop high-quality mobile applications for iOS and Android platforms</li>
            <li>Collaborate with cross-functional teams to define requirements and deliver solutions that meet customer needs</li>
            <li>Implement best practices for mobile app development, including performance optimization, security, and usability</li>
            <li>Participate in code reviews and provide constructive feedback to ensure code quality</li>
            <li>Stay updated on the latest trends and technologies in mobile app development</li>
            <li>Contribute to the improvement of development processes and methodologies</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates with:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience in mobile app development for iOS and/or Android platforms</li>
            <li>Proficiency in programming languages such as Swift, Objective-C, Java, or Kotlin</li>
            <li>Strong understanding of mobile UI/UX design principles and best practices</li>
            <li>Experience with mobile app testing, debugging, and performance optimization</li>
            <li>Excellent communication and collaboration skills</li>
        </ul>',
            'benefits' => '<p>At SAP, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on innovative projects with global impact</li>
            <li>Continuous learning and development opportunities</li>
            <li>Dynamic and inclusive work environment</li>
            <li>Flexible working arrangements</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 24,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 12,
            'application_deadline' => '2024-04-15',
            'status' => Job::STATUS_ACTIVE
        ],
        [//TelQ - SQl, Java, Git, Selenium, REST, QA, Agile, Intermediate
            'name' => 'Automated QA Engineer',
            'description' => '<p>Join TelQ, a leading telecommunications company, and play a key role in ensuring the quality and reliability of our cutting-edge software solutions. As an Automated QA Engineer, you will leverage your expertise in automated testing to drive continuous improvement and deliver exceptional products to our customers.</p>',
            'responsibilities' => '<p>As an Automated QA Engineer at TelQ, you will:</p>
        <ul>
            <li>Design, develop, and maintain automated test suites for web and mobile applications</li>
            <li>Collaborate with software engineers and product managers to understand requirements and acceptance criteria</li>
            <li>Identify and prioritize test cases for automation based on risk and impact</li>
            <li>Execute automated tests and analyze results to identify defects and ensure software quality</li>
            <li>Participate in Agile development processes, including sprint planning, daily stand-ups, and retrospectives</li>
            <li>Contribute to the improvement of QA processes and methodologies</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates with:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Strong experience in automated testing frameworks and tools, such as Selenium, Appium, or similar</li>
            <li>Proficiency in programming languages such as Java, Python, or JavaScript</li>
            <li>Solid understanding of software testing principles and methodologies</li>
            <li>Experience with Agile development practices and tools (e.g., Jira, Confluence)</li>
            <li>Excellent analytical and problem-solving skills</li>
        </ul>',
            'benefits' => '<p>At TelQ, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work with cutting-edge technologies in a dynamic environment</li>
            <li>Flexible working hours and remote work options</li>
            <li>Continuous learning and development opportunities</li>
            <li>Friendly and collaborative team culture</li>
        </ul>',
            'category_id' => 4,
            'city_id' => 10,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 1,
            'company_id' => 13,
            'application_deadline' => '2024-04-10',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Vega IT - cloud, REST, Java, Python, Junior
            'name' => 'Software Developer Intern',
            'description' => '<p>Embark on an exciting journey with Vega IT, a leading software development company, and gain hands-on experience in building cutting-edge solutions. As a Software Developer Intern, you will have the opportunity to work alongside seasoned professionals and contribute to real-world projects while honing your skills in cloud-based and RESTful technologies.</p>',
            'responsibilities' => '<p>As a Software Developer Intern at Vega IT, you will:</p>
        <ul>
            <li>Assist in the design, development, and implementation of software applications</li>
            <li>Collaborate with team members to create and maintain RESTful APIs</li>
            <li>Work with cloud platforms such as AWS, Azure, or Google Cloud to deploy and manage applications</li>
            <li>Participate in code reviews and provide feedback to improve code quality</li>
            <li>Contribute to the documentation of software functionalities and technical specifications</li>
            <li>Learn and apply best practices in software development and agile methodologies</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who:</p>
        <ul>
            <li>Are currently pursuing a degree in Computer Science, Software Engineering, or related field</li>
            <li>Have a basic understanding of cloud computing concepts and RESTful architecture</li>
            <li>Are familiar with programming languages such as Java, Python, or JavaScript</li>
            <li>Have strong analytical and problem-solving skills</li>
            <li>Are passionate about technology and eager to learn and grow</li>
        </ul>',
            'benefits' => '<p>As a Software Developer Intern at Vega IT, you will receive:</p>
        <ul>
            <li>Guidance and mentorship from experienced professionals</li>
            <li>Opportunity to work on diverse and challenging projects</li>
            <li>Hands-on experience with cutting-edge technologies</li>
            <li>Flexible work hours and a supportive work environment</li>
            <li>Potential for future career opportunities within the company</li>
        </ul>',
            'category_id' => 5,
            'city_id' => 17,
            'seniority_id' => 1,
            'full_time' => false,
            'workplace_id' => 1,
            'company_id' => 7,
            'application_deadline' => '2024-03-15',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Mondi - SCRUM, Agile, Senior, Jira, Confluence
            'name' => 'Senior Project/Program Manager & PMO Lead',
            'description' => '<p>Join Mondi, a global leader in packaging and paper products, and take on a pivotal role in driving project excellence and organizational efficiency. As a Senior Project/Program Manager & PMO Lead, you will lead strategic initiatives, oversee project portfolios, and champion best practices in project management, leveraging advanced tools and methodologies.</p>',
            'responsibilities' => '<p>As a Senior Project/Program Manager & PMO Lead at Mondi, you will:</p>
        <ul>
            <li>Lead the planning, execution, and delivery of complex projects and programs</li>
            <li>Establish and maintain project management standards, processes, and methodologies</li>
            <li>Provide leadership and direction to project teams, ensuring alignment with organizational goals</li>
            <li>Develop and maintain project schedules, budgets, and resource allocation plans</li>
            <li>Oversee risk management, issue resolution, and change management processes</li>
            <li>Serve as a liaison between project teams, stakeholders, and senior management</li>
            <li>Lead the PMO function, including governance, reporting, and continuous improvement initiatives</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who:</p>
        <ul>
            <li>Have extensive experience in project and program management, preferably in a leadership role</li>
            <li>Demonstrate proficiency in project management tools such as Jira and Confluence</li>
            <li>Possess advanced knowledge of project management methodologies, including SCRUM and Agile</li>
            <li>Have excellent communication, negotiation, and stakeholder management skills</li>
            <li>Hold relevant certifications such as PMP, PRINCE2, or Agile certifications</li>
            <li>Exhibit strong leadership capabilities and a track record of driving successful project outcomes</li>
        </ul>',
            'benefits' => '<p>At Mondi, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on strategic projects with global impact</li>
            <li>Dynamic and inclusive work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive leadership and career growth prospects</li>
        </ul>',
            'category_id' => 3,
            'city_id' => 25,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 3,
            'company_id' => 10,
            'salary' => 6000,
            'application_deadline' => '2024-03-20',
            'status' => Job::STATUS_ACTIVE
        ],
        [//sa.global - MySQL, Linux, Spring, Java, Maven, Hibernate, MVC, ActiveMQ , Intermediate to Senior
            'name' => 'Software Development Team Lead',
            'description' => '<p>Join sa.global, a leading provider of Microsoft Dynamics solutions, and lead a talented team of software developers in delivering innovative solutions to clients worldwide. As a Software Development Team Lead, you will play a critical role in driving the design, development, and implementation of cutting-edge software solutions, utilizing a wide range of technologies including MySQL, Linux, Spring, Java, Maven, Hibernate, MVC, JMS, andJob::self::STATUS_ACTIVEQ.</p>',
            'responsibilities' => '<p>As a Software Development Team Lead at sa.global, you will:</p>
        <ul>
            <li>Lead and mentor a team of software developers, providing guidance and support to ensure project success</li>
            <li>Drive the technical architecture, design, and development of software solutions</li>
            <li>Collaborate with product managers and stakeholders to define project requirements and priorities</li>
            <li>Ensure adherence to best practices, coding standards, and development methodologies</li>
            <li>Manage project timelines, resources, and deliverables to meet business objectives</li>
            <li>Conduct code reviews, identify areas for improvement, and implement solutions</li>
            <li>Stay current with emerging technologies and industry trends</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Extensive experience in software development, with a strong proficiency in Java and related technologies</li>
            <li>Experience with MySQL, Linux, Spring, Maven, Hibernate, MVC, JMS, and ActiveMQ</li>
            <li>Demonstrated leadership skills, with the ability to inspire and motivate a team</li>
            <li>Excellent communication and interpersonal skills</li>
            <li>Strong problem-solving abilities and attention to detail</li>
            <li>Experience working in Agile environments</li>
            <li>A commitment to continuous learning and professional development</li>
        </ul>',
            'benefits' => '<p>At sa.global, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on exciting projects with global impact</li>
            <li>Supportive work environment with opportunities for growth and advancement</li>
            <li>Flexible work arrangements and remote work options</li>
            <li>Continuous learning and professional development programs</li>
        </ul>',
            'category_id' => 3,
            'city_id' => 5,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 2,
            'salary' => 5500,
            'application_deadline' => '2024-03-10',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Microsoft -.NET, C#, ASP.NET, NoSQL,SQL LINQ, Entity FrameworkSOA,Agile, Senior,SQL Server, ASP.NET MVC
            'name' => 'Staff Engineer (.NET Backend Developer)',
            'description' => '<p>Join Microsoft, a global leader in technology, and contribute to the development of cutting-edge software solutions as a Staff Engineer specializing in .NET backend development. In this role, you will leverage your expertise in .NET technologies to design, develop, and implement robust backend systems that power Microsoft’s diverse range of products and services.</p>',
            'responsibilities' => '<p>As a Staff Engineer (.NET Backend Developer) at Microsoft, you will:</p>
        <ul>
            <li>Lead the design and development of scalable and high-performance backend systems using .NET technologies</li>
            <li>Collaborate with cross-functional teams to define technical requirements and architecture</li>
            <li>Implement best practices for .NET development, including code optimization, security, and performance tuning</li>
            <li>Utilize NoSQL and SQL databases to store and retrieve data efficiently</li>
            <li>Work with LINQ and Entity Framework for data access and manipulation</li>
            <li>Design and implement service-oriented architectures (SOA) to enable interoperability and scalability</li>
            <li>Participate in Agile development methodologies, including sprint planning, daily stand-ups, and retrospectives</li>
            <li>Provide technical leadership and mentorship to junior team members</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Extensive experience in .NET development, with proficiency in C# and ASP.NET</li>
            <li>Strong knowledge of NoSQL and SQL databases, including SQL Server</li>
            <li>Experience with LINQ and Entity Framework for data access</li>
            <li>Understanding of service-oriented architectures (SOA) and microservices</li>
            <li>Experience working in Agile development environments</li>
            <li>Demonstrated ability to lead and mentor team members</li>
        </ul>',
            'benefits' => '<p>At Microsoft, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on cutting-edge technologies and projects</li>
            <li>Dynamic and inclusive work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Work-life balance and flexibility</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 1,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 11,
            'application_deadline' => '2024-03-15',
            'status' => Job::STATUS_ACTIVE
        ],
        [//sa.global - SCRUM, Agile, Senior
            'name' => 'Senior Product Owner',
            'description' => '<p>Join sa.global, a leading provider of Microsoft Dynamics solutions, and lead the development of innovative software products as a Senior Product Owner. In this role, you will collaborate closely with stakeholders and development teams to define product vision, prioritize features, and drive the delivery of high-quality solutions utilizing SCRUM and Agile methodologies.</p>',
            'responsibilities' => '<p>As a Senior Product Owner at sa.global, you will:</p>
        <ul>
            <li>Define and communicate the product vision, roadmap, and release plan</li>
            <li>Collaborate with stakeholders to gather and prioritize product requirements</li>
            <li>Translate business needs into user stories, acceptance criteria, and product backlog items</li>
            <li>Work closely with development teams to ensure alignment with product goals and user needs</li>
            <li>Lead sprint planning, backlog grooming, and sprint review sessions</li>
            <li>Monitor project progress, identify risks, and implement mitigation strategies</li>
            <li>Drive continuous improvement through feedback loops and retrospectives</li>
            <li>Act as the voice of the customer and advocate for their needs throughout the development process</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Proven experience as a Product Owner or similar role, preferably in an Agile environment</li>
            <li>Strong understanding of SCRUM and Agile methodologies</li>
            <li>Excellent communication, negotiation, and stakeholder management skills</li>
            <li>Ability to prioritize and make decisions in a fast-paced environment</li>
            <li>Experience working with development teams to deliver software products</li>
            <li>Knowledge of Microsoft Dynamics or ERP systems is a plus</li>
            <li>Relevant certifications such as CSPO or PSPO are desirable</li>
        </ul>',
            'benefits' => '<p>At sa.global, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on cutting-edge projects with global impact</li>
            <li>Supportive work environment with opportunities for growth and advancement</li>
            <li>Flexible work arrangements and remote work options</li>
            <li>Continuous learning and professional development programs</li>
        </ul>',
            'category_id' => 3,
            'city_id' => 23,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 3,
            'company_id' => 2,
            'application_deadline' => '2024-03-12',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Levi9 - Java, Scala, Agile, Junior
            'name' => 'Java/Scala Intern',
            'description' => '<p>Embark on an exciting learning journey with Levi9, a leading software development company, and kick-start your career as a Java/Scala Intern. In this role, you will have the opportunity to work with cutting-edge technologies, including Java, Scala, and Agile methodologies, while gaining hands-on experience and mentorship from industry professionals.</p>',
            'responsibilities' => '<p>As a Java/Scala Intern at Levi9, you will:</p>
        <ul>
            <li>Participate in software development projects using Java and Scala programming languages</li>
            <li>Collaborate with team members to design, develop, and test software solutions</li>
            <li>Contribute to Agile ceremonies, including sprint planning, daily stand-ups, and retrospectives</li>
            <li>Learn best practices in software development, code review processes, and version control</li>
            <li>Assist in troubleshooting and debugging issues, and provide support as needed</li>
            <li>Gain exposure to different aspects of software development lifecycle</li>
            <li>Receive mentorship and guidance from experienced developers</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who:</p>
        <ul>
            <li>Are currently pursuing a degree in Computer Science, Software Engineering, or related field</li>
            <li>Have basic knowledge of Java or Scala programming languages</li>
            <li>Are passionate about technology and eager to learn and grow</li>
            <li>Have good communication and interpersonal skills</li>
            <li>Are able to work effectively in a team environment</li>
            <li>Are familiar with Agile methodologies or willing to learn</li>
        </ul>',
            'benefits' => '<p>As a Java/Scala Intern at Levi9, you will receive:</p>
        <ul>
            <li>Valuable hands-on experience with industry-leading technologies</li>
            <li>Mentorship and guidance from experienced professionals</li>
            <li>Opportunity to work on real-world projects and make an impact</li>
            <li>Flexible work arrangements and supportive work environment</li>
            <li>Continuous learning and professional development opportunities</li>
        </ul>',
            'category_id' => 5,
            'city_id' => 7,
            'seniority_id' => 1,
            'full_time' => false,
            'workplace_id' => 1,
            'company_id' => 6,
            'application_deadline' => '2024-04-05',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Google - CSS,HTML, Selenium, Cypress, Git, Agile, Senior, QA,HTTP, RESTful

            'name' => 'Sr. Software QA Engineer Lead',
            'description' => '<p>Join Google, a global technology leader, and lead the quality assurance efforts for groundbreaking software products as a Senior Software QA Engineer Lead. In this role, you will leverage your expertise in quality assurance methodologies and technologies to ensure the delivery of high-quality software solutions that meet the highest standards of performance, reliability, and user experience.</p>',
            'responsibilities' => '<p>As a Sr. Software QA Engineer Lead at Google, you will:</p>
        <ul>
            <li>Lead a team of QA engineers in developing and executing test plans, test cases, and test scripts</li>
            <li>Define and implement QA processes, standards, and best practices</li>
            <li>Collaborate with cross-functional teams to understand project requirements and priorities</li>
            <li>Perform manual and automated testing of web applications, APIs, and mobile apps</li>
            <li>Utilize tools such as Selenium, Cypress, and Git for test automation and version control</li>
            <li>Conduct performance testing, load testing, and security testing as needed</li>
            <li>Monitor and report on test results, defects, and quality metrics</li>
            <li>Champion continuous improvement initiatives to enhance QA efficiency and effectiveness</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Extensive experience in software quality assurance, with a focus on web and mobile applications</li>
            <li>Proficiency in HTML, CSS, and web technologies</li>
            <li>Strong understanding of QA methodologies, tools, and processes</li>
            <li>Hands-on experience with test automation frameworks such as Selenium and Cypress</li>
            <li>Knowledge of version control systems, preferably Git</li>
            <li>Experience with Agile development methodologies and practices</li>
            <li>Excellent analytical, problem-solving, and communication skills</li>
        </ul>',
            'benefits' => '<p>At Google, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on cutting-edge projects with global impact</li>
            <li>Dynamic and inclusive work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 4,
            'city_id' => 1,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 1,
            'application_deadline' => '2024-03-25',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Oracle - Angular, NodeJS, MongoDB, Express.js, HTML, CSS,Intermediate
            'name' => 'Angular/NodeJS Developer (MEAN Stack)',
            'description' => '<p>Join Oracle, a global leader in cloud computing and enterprise software solutions, and contribute to the development of cutting-edge applications as an Angular/NodeJS Developer specializing in the MEAN stack. In this role, you will utilize your expertise in JavaScript, CSS, HTML, Angular, and NodeJS to design, develop, and maintain innovative software solutions that drive business growth and success.</p>',
            'responsibilities' => '<p>As an Angular/NodeJS Developer at Oracle, you will:</p>
        <ul>
            <li>Design and develop responsive web applications using Angular, NodeJS, and other front-end technologies</li>
            <li>Collaborate with cross-functional teams to define technical requirements and user stories</li>
            <li>Implement user interfaces and application logic to deliver high-quality software solutions</li>
            <li>Optimize application performance and ensure scalability and security</li>
            <li>Participate in code reviews, debugging, and troubleshooting to maintain code quality</li>
            <li>Stay updated on emerging technologies and industry best practices</li>
            <li>Contribute to the continuous improvement of development processes and methodologies</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Experience in full-stack development using the MEAN stack (MongoDB, Express.js, Angular, Node.js)</li>
            <li>Proficiency in JavaScript, CSS, and HTML</li>
            <li>Strong understanding of web development principles and best practices</li>
            <li>Experience with version control systems, preferably Git</li>
            <li>Ability to work effectively in a fast-paced, dynamic environment</li>
            <li>Excellent problem-solving and communication skills</li>
        </ul>',
            'benefits' => '<p>At Oracle, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on innovative projects with global impact</li>
            <li>Dynamic and inclusive work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 17,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 1,
            'company_id' => 4,
            'salary' => 4000,
            'application_deadline' => '2024-03-17',
            'status' => Job::STATUS_ACTIVE
        ],
        [//IBM - PHP, MySQL, JavaScript, CSS, HTML, Intermediate to Senior, Ajax, SASS, jQuery, LESS, Bootstrap, XML,
            // JSON, Git, RESTful, WordPress
            'name' => 'Full Stack Web Developer (WordPress)',
            'description' => '<p>Join IBM, a global leader in technology and innovation, and contribute to the development of dynamic web solutions as a Full Stack Web Developer specializing in WordPress. In this role, you will utilize your expertise in PHP, MySQL, JavaScript, CSS, and other front-end and back-end technologies to design, develop, and maintain high-quality websites and web applications.</p>',
            'responsibilities' => '<p>As a Full Stack Web Developer at IBM, you will:</p>
        <ul>
            <li>Design and develop custom WordPress themes and plugins</li>
            <li>Work closely with clients and stakeholders to understand project requirements and objectives</li>
            <li>Implement front-end and back-end functionalities using PHP, MySQL, JavaScript, CSS, Ajax, and HTML</li>
            <li>Optimize websites for speed, performance, and responsiveness</li>
            <li>Integrate third-party APIs and services as needed</li>
            <li>Ensure code quality, security, and compliance with industry standards</li>
            <li>Collaborate with designers, developers, and other team members to deliver projects on time and within budget</li>
            <li>Provide technical support and troubleshooting for WordPress sites</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience in full-stack web development with expertise in WordPress</li>
            <li>Strong proficiency in PHP, MySQL, JavaScript, CSS, and HTML</li>
            <li>Experience with front-end frameworks and libraries such as jQuery, Bootstrap, and SASS</li>
            <li>Knowledge of version control systems, preferably Git</li>
            <li>Understanding of RESTful APIs, XML, and JSON</li>
            <li>Ability to work independently and collaboratively in a fast-paced environment</li>
            <li>Excellent communication and problem-solving skills</li>
        </ul>',
            'benefits' => '<p>At IBM, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on innovative projects with global impact</li>
            <li>Dynamic and inclusive work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 18,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 9,
            'application_deadline' => '2024-03-20',
            'status' => Job::STATUS_ACTIVE
        ],
        [//DXC - SQL, Linux, Oracle, RDBMS, PL/SQL, Intermediate
            'name' => 'Database Administrator',
            'description' => '<p>Join DXC, a global leader in providing technology services and solutions, and play a vital role in managing and optimizing database systems as a Database Administrator. In this role, you will leverage your expertise in SQL, Linux, Oracle, RDBMS, and PL/SQL to ensure the reliability, security, and performance of mission-critical databases.</p>',
            'responsibilities' => '<p>As a Database Administrator at DXC, you will:</p>
        <ul>
            <li>Install, configure, and maintain database management systems, primarily Oracle</li>
            <li>Perform database upgrades, patches, and migrations as required</li>
            <li>Monitor database performance, troubleshoot issues, and optimize SQL queries</li>
            <li>Implement and maintain database security policies and procedures</li>
            <li>Create and manage database users, roles, and permissions</li>
            <li>Develop and maintain database documentation, including backup and recovery procedures</li>
            <li>Provide technical support and assistance to application developers and end-users</li>
            <li>Participate in disaster recovery planning and testing</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Information Technology, or related field</li>
            <li>Proven experience as a Database Administrator, preferably with Oracle databases</li>
            <li>Strong proficiency in SQL and PL/SQL</li>
            <li>Experience with Linux operating systems and shell scripting</li>
            <li>Knowledge of relational database management systems (RDBMS) concepts and principles</li>
            <li>Ability to analyze and troubleshoot database performance issues</li>
            <li>Excellent communication and interpersonal skills</li>
            <li>Relevant certifications such as Oracle Certified Professional (OCP) are a plus</li>
        </ul>',
            'benefits' => '<p>At DXC, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on diverse projects with global impact</li>
            <li>Dynamic and collaborative work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 2,
            'city_id' => 10,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 1,
            'company_id' => 5,
            'application_deadline' => '2024-03-22',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Netcare - Jenkins, TeamCity, QA, Intermediate
            'name' => 'QA Engineer (mobile & API)',
            'description' => '<p>Join Netcare, a leading provider of technology solutions, and ensure the quality and reliability of mobile and API applications as a QA Engineer. In this role, you will utilize your expertise in testing methodologies and tools to conduct comprehensive testing of mobile applications and APIs, ensuring a seamless user experience and optimal performance.</p>',
            'responsibilities' => '<p>As a QA Engineer at Netcare, you will:</p>
        <ul>
            <li>Design and execute test cases and test scenarios for mobile and API applications</li>
            <li>Perform functional, regression, and performance testing of mobile apps on different devices and platforms</li>
            <li>Test API endpoints for functionality, reliability, and security</li>
            <li>Develop and maintain automated test scripts using tools like Jenkins and TeamCity</li>
            <li>Identify and document software defects, track issues, and verify bug fixes</li>
            <li>Collaborate with developers, product managers, and other stakeholders to ensure high-quality deliverables</li>
            <li>Contribute to the continuous improvement of testing processes and methodologies</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience in software quality assurance, with a focus on mobile and API testing</li>
            <li>Strong understanding of testing methodologies, processes, and best practices</li>
            <li>Experience with automation tools such as Jenkins, TeamCity, and other CI/CD tools</li>
            <li>Proficiency in writing and executing SQL queries for database testing</li>
            <li>Excellent analytical and problem-solving skills</li>
            <li>Ability to work effectively in a fast-paced, dynamic environment</li>
        </ul>',
            'benefits' => '<p>At Netcare, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on innovative projects with global impact</li>
            <li>Dynamic and collaborative work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 4,
            'city_id' => 1,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 3,
            'company_id' => 16,
            'application_deadline' => '2024-05-01',
            'status' => Job::STATUS_ACTIVE
        ],
        [//RT-RK - MySQL, Docker, PostgreSQL, Bootstrap, REST, Node.js, React.js, Cloud, MongoDB, Agile, Next.js, Senior
            'name' => 'Technical Lead',
            'description' => '<p>Join RT-RK, a leading technology company, and take on a leadership role in driving the development of innovative software solutions as a Technical Lead. In this position, you will leverage your expertise in a wide range of technologies, including MySQL, Docker, PostgreSQL, Bootstrap, REST, Node.js, React.js, Cloud, MongoDB, Agile, and Next.js, to lead a team of developers and deliver high-quality, scalable, and efficient software products.</p>',
            'responsibilities' => '<p>As a Technical Lead at RT-RK, you will:</p>
        <ul>
            <li>Lead and mentor a team of developers, providing technical guidance and support</li>
            <li>Architect and design software solutions, ensuring scalability, performance, and maintainability</li>
            <li>Collaborate with product managers, designers, and stakeholders to define project requirements and objectives</li>
            <li>Participate in the full software development lifecycle, from requirements analysis to deployment</li>
            <li>Develop and maintain high-quality code, following best practices and coding standards</li>
            <li>Implement and maintain CI/CD pipelines using Docker and other DevOps tools</li>
            <li>Stay updated on emerging technologies and industry trends, and drive innovation within the team</li>
            <li>Promote Agile principles and practices, and facilitate sprint planning, daily stand-ups, and retrospectives</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience in software development, with a focus on full-stack development and architecture</li>
            <li>Strong proficiency in MySQL, PostgreSQL, Node.js, React.js, and other relevant technologies</li>
            <li>Experience with Docker, Cloud platforms, and MongoDB</li>
            <li>Solid understanding of RESTful API design and implementation</li>
            <li>Excellent leadership, communication, and problem-solving skills</li>
            <li>Ability to thrive in a fast-paced, dynamic environment</li>
            <li>Relevant certifications such as AWS Certified Solutions Architect or Scrum Master are a plus</li>
        </ul>',
            'benefits' => '<p>At RT-RK, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on cutting-edge projects with global impact</li>
            <li>Dynamic and collaborative work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 3,
            'city_id' => 17,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 15,
            'salary' => 6000,
            'application_deadline' => '2024-04-10',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Quantox Technology - Python, AWS, Maven, Ansible, Jenkins, JSON, Azure, DevOps, PowerShell, Bash, Senior
            'name' => 'Development Operations Engineer (AWS)',
            'description' => '<p>Join Quantox Technology, a dynamic and innovative technology company, and play a key role in the deployment and management of cloud infrastructure as a Development Operations Engineer specializing in AWS. In this position, you will leverage your expertise in a variety of technologies, including Python, AWS, Maven, Ansible, Jenkins, JSON, Azure, DevOps, PowerShell, and Bash, to ensure the reliability, scalability, and security of cloud-based applications and services.</p>',
            'responsibilities' => '<p>As a Development Operations Engineer at Quantox Technology, you will:</p>
        <ul>
            <li>Design, implement, and maintain cloud infrastructure using AWS services</li>
            <li>Automate deployment processes using tools like Ansible, Jenkins, and PowerShell</li>
            <li>Develop and maintain CI/CD pipelines to enable continuous integration and deployment</li>
            <li>Monitor and optimize cloud resources for performance, cost, and security</li>
            <li>Collaborate with development teams to troubleshoot issues and implement solutions</li>
            <li>Implement security best practices and ensure compliance with industry standards</li>
            <li>Stay updated on emerging technologies and recommend tools and solutions to improve efficiency</li>
            <li>Provide technical support and assistance to internal teams and clients</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience in cloud infrastructure management, preferably with AWS</li>
            <li>Strong proficiency in Python, PowerShell, and Bash scripting</li>
            <li>Experience with automation tools such as Ansible, Jenkins, and Maven</li>
            <li>Knowledge of cloud platforms and services, including Azure</li>
            <li>Familiarity with DevOps principles and practices</li>
            <li>Excellent problem-solving and communication skills</li>
            <li>Relevant certifications such as AWS Certified DevOps Engineer are a plus</li>
        </ul>',
            'benefits' => '<p>At Quantox Technology, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on cutting-edge projects with global impact</li>
            <li>Dynamic and collaborative work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 28,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 14,
            'application_deadline' => '2024-04-15',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Netcare - SQL , Junior
            'name' => 'Microsoft Certification Training',
            'description' => '<p>Join Netcare, a leading provider of technology solutions, and kick-start your career in database management with our Microsoft Certification Training program. This training opportunity is designed for individuals interested in gaining expertise in SQL, one of the most widely used database languages, and obtaining valuable Microsoft certifications to enhance their professional credentials.</p>',
            'responsibilities' => '<p>As a participant in the Microsoft Certification Training program at Netcare, you will:</p>
        <ul>
            <li>Participate in comprehensive training sessions covering SQL fundamentals and advanced topics</li>
            <li>Gain hands-on experience with SQL database management systems</li>
            <li>Prepare for Microsoft certification exams, including SQL Server certifications</li>
            <li>Work on practical projects and assignments to reinforce your learning</li>
            <li>Collaborate with experienced trainers and mentors to accelerate your learning curve</li>
            <li>Stay updated on the latest developments in database technologies and best practices</li>
        </ul>',
            'requirements' => '<p>This training program is suitable for individuals who:</p>
        <ul>
            <li>Have basic knowledge of computer science and database concepts</li>
            <li>Are eager to learn and passionate about pursuing a career in database management</li>
            <li>Are committed to dedicating time and effort to the training program</li>
            <li>Possess strong problem-solving and analytical skills</li>
            <li>Are eligible to work in the country where the training program is offered</li>
        </ul>',
            'benefits' => '<p>At Netcare, we offer:</p>
        <ul>
            <li>Structured training program led by experienced professionals</li>
            <li>Opportunity to obtain valuable Microsoft certifications</li>
            <li>Hands-on experience with real-world database projects</li>
            <li>Mentorship and guidance to support your learning journey</li>
            <li>Potential career advancement opportunities within Netcare</li>
        </ul>',
            'category_id' => 5,
            'city_id' => 1,
            'seniority_id' => 1,
            'full_time' => false,
            'workplace_id' => 1,
            'company_id' => 16,
            'application_deadline' => '2024-04-01',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Levi9 - Java, C#, OOP, Junior
            'name' => 'UI/Frontend Internship',
            'description' => '<p>Embark on a rewarding learning journey with Levi9, a leading software development company, and gain practical experience in UI/Frontend development through our internship program. This internship opportunity is designed for individuals eager to dive into the world of user interface design and development, with a focus on Object-Oriented Programming (OOP), Java, and C#.</p>',
            'responsibilities' => '<p>As an intern in the UI/Frontend team at Levi9, you will:</p>
        <ul>
            <li>Work closely with experienced developers on real-world projects</li>
            <li>Learn and apply principles of Object-Oriented Programming (OOP)</li>
            <li>Participate in the design and development of user-friendly interfaces</li>
            <li>Collaborate with designers to implement visual designs and prototypes</li>
            <li>Write clean, maintainable code using Java and C#</li>
            <li>Conduct testing and debugging to ensure quality and reliability</li>
            <li>Stay updated on emerging trends and best practices in UI/Frontend development</li>
        </ul>',
            'requirements' => '<p>This internship program is suitable for individuals who:</p>
        <ul>
            <li>Are pursuing or recently completed a degree in Computer Science, Engineering, or related field</li>
            <li>Have a strong interest in UI/Frontend development and design</li>
            <li>Have basic knowledge of Object-Oriented Programming concepts</li>
            <li>Are familiar with programming languages such as Java and C#</li>
            <li>Are eager to learn, adaptable, and prJob::self::STATUS_ACTIVE/li>
            <li>Possess good communication and teamwork skills</li>
        </ul>',
            'benefits' => '<p>At Levi9, we offer:</p>
        <ul>
            <li>Hands-on experience working on real projects</li>
            <li>Guidance and mentorship from experienced professionals</li>
            <li>Opportunity to build a strong foundation in UI/Frontend development</li>
            <li>Networking opportunities with industry experts</li>
            <li>Potential for career advancement within Levi9</li>
        </ul>',
            'category_id' => 5,
            'city_id' => 17,
            'seniority_id' => 1,
            'full_time' => false,
            'workplace_id' => 1,
            'company_id' => 6,
            'application_deadline' => '2024-04-05',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Quantox - QA, RESTful, Microservices, Senior
            'name' => 'Head of QA',
            'description' => '<p>Take the lead in ensuring the quality and reliability of our software products as the Head of QA at Quantox, a leading technology company. In this role, you will oversee all aspects of the quality assurance process, with a focus on implementing best practices and strategies to achieve excellence in QA. With expertise in QA methodologies, RESTful APIs, and Microservices architecture, you will drive the QA team towards delivering high-quality software solutions.</p>',
            'responsibilities' => '<p>As the Head of QA at Quantox, you will:</p>
        <ul>
            <li>Develop and implement QA strategies, policies, and procedures</li>
            <li>Lead and mentor a team of QA engineers, providing guidance and support</li>
            <li>Define QA standards and ensure adherence to quality processes</li>
            <li>Establish and maintain automated testing frameworks and tools</li>
            <li>Collaborate with development teams to integrate QA into the software development lifecycle</li>
            <li>Perform risk analysis and prioritize testing efforts based on business needs</li>
            <li>Monitor and analyze QA metrics to identify areas for improvement</li>
            <li>Stay updated on emerging technologies and industry trends in QA and software testing</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience in QA leadership roles, with a track record of success</li>
            <li>Deep understanding of QA methodologies, processes, and best practices</li>
            <li>Experience with testing RESTful APIs and Microservices architecture</li>
            <li>Strong analytical and problem-solving skills</li>
            <li>Excellent communication and leadership abilities</li>
            <li>Relevant certifications such as ISTQB Certified Tester are a plus</li>
        </ul>',
            'benefits' => '<p>At Quantox, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to lead and shape the QA function in a dynamic environment</li>
            <li>Professional development and growth opportunities</li>
            <li>Supportive work culture and collaborative team environment</li>
            <li>Exciting projects with global impact</li>
        </ul>',
            'category_id' => 4,
            'city_id' => 28,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 14,
            'application_deadline' => '2024-03-25',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Strabag -SQL, Linux, Windows Server, Oracle, CMS, Microsoft SQL Server, Intermediate
            'name' => 'Medior OpenText Specialist',
            'description' => '<p>Join Strabag, a leading construction and technology company, as a Medior OpenText Specialist and play a key role in managing and optimizing our OpenText systems. In this position, you will leverage your expertise in a variety of technologies, including SQL, Linux, Windows Server, Oracle, CMS, and Microsoft SQL Server, to ensure the reliability, security, and performance of our OpenText solutions.</p>',
            'responsibilities' => '<p>As a Medior OpenText Specialist at Strabag, you will:</p>
        <ul>
            <li>Install, configure, and maintain OpenText systems and applications</li>
            <li>Optimize system performance and troubleshoot issues as they arise</li>
            <li>Implement and manage integrations with other systems and platforms</li>
            <li>Develop and maintain documentation for system configurations and processes</li>
            <li>Collaborate with other IT teams to ensure seamless operation of OpenText systems</li>
            <li>Provide technical support and assistance to end-users as needed</li>
            <li>Stay updated on emerging technologies and best practices in ECM (Enterprise Content Management)</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Information Technology, or related field</li>
            <li>Proven experience in managing OpenText systems and applications</li>
            <li>Strong proficiency in SQL, Linux, and Windows Server environments</li>
            <li>Experience with Oracle and Microsoft SQL Server databases</li>
            <li>Familiarity with content management systems (CMS) and ECM principles</li>
            <li>Excellent problem-solving and analytical skills</li>
            <li>Effective communication and teamwork abilities</li>
        </ul>',
            'benefits' => '<p>At Strabag, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on exciting projects in a dynamic environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and collaborative team environment</li>
            <li>Potential for career advancement within Strabag</li>
        </ul>',
            'category_id' => 2,
            'city_id' => 20,
            'seniority_id' => 2,
            'full_time' => true,
            'workplace_id' => 1,
            'company_id' => 8,
            'application_deadline' => '2024-03-30',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Ubisoft - C#, Unity, OOP,Senior
            'name' => 'Senior Game Developer - C#, Unity',
            'description' => '<p>Join Ubisoft, a leading video game company, and take on a key role in developing cutting-edge games as a Senior Game Developer. In this position, you will leverage your expertise in C#, Object-Oriented Programming (OOP), and Unity to contribute to the development of innovative and engaging gaming experiences.</p>',
            'responsibilities' => '<p>As a Senior Game Developer at Ubisoft, you will:</p>
        <ul>
            <li>Design and implement game features and mechanics using C# and Unity</li>
            <li>Collaborate with cross-functional teams including designers, artists, and producers</li>
            <li>Optimize game performance and memory usage for various platforms</li>
            <li>Write clean, efficient, and maintainable code following best practices</li>
            <li>Debug and troubleshoot issues, and implement solutions to ensure smooth gameplay</li>
            <li>Mentor junior developers and provide technical guidance and support</li>
            <li>Stay updated on emerging technologies and industry trends in game development</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience in game development using C# and Unity</li>
            <li>Strong understanding of Object-Oriented Programming principles</li>
            <li>Experience with game optimization techniques and performance profiling</li>
            <li>Excellent problem-solving and analytical skills</li>
            <li>Effective communication and teamwork abilities</li>
            <li>Prior experience in a senior or lead role is a plus</li>
        </ul>',
            'benefits' => '<p>At Ubisoft, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on exciting projects with global impact</li>
            <li>Dynamic and collaborative work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 1,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 19,
            'salary' => 5000,
            'application_deadline' => '2024-04-02',
            'status' => Job::STATUS_ACTIVE
        ],
        [//sa.global - SQL, Jira, Confluence,QA ,SCRUM, Agile, Senior
            'name' => 'QA Engineer',
            'description' => '<p>Join sa.global, a leading software consulting firm, as a QA Engineer and play a crucial role in ensuring the quality and reliability of our software solutions. As a Senior QA Engineer, you will utilize your expertise in a variety of technologies, including SQL, Jira, Confluence, QA methodologies, SCRUM, and Agile, to drive the testing process and deliver high-quality products to our clients.</p>',
            'responsibilities' => '<p>As a Senior QA Engineer at sa.global, you will:</p>
        <ul>
            <li>Develop and execute test plans, test cases, and test scripts</li>
            <li>Perform functional, regression, and performance testing on software applications</li>
            <li>Identify, document, and track software defects to resolution</li>
            <li>Collaborate with development teams to ensure timely resolution of issues</li>
            <li>Participate in Agile ceremonies such as sprint planning, daily stand-ups, and retrospectives</li>
            <li>Contribute to the continuous improvement of QA processes and methodologies</li>
            <li>Provide mentorship and guidance to junior members of the QA team</li>
            <li>Stay updated on industry trends and best practices in software testing</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Proven experience as a QA Engineer, preferably in a Senior role</li>
            <li>Strong proficiency in SQL for database testing and querying</li>
            <li>Experience with testing tools such as Jira, Confluence, and other QA management systems</li>
            <li>Thorough understanding of QA methodologies, SCRUM, and Agile practices</li>
            <li>Excellent problem-solving and analytical skills</li>
            <li>Effective communication and teamwork abilities</li>
        </ul>',
            'benefits' => '<p>At sa.global, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on challenging projects with global clients</li>
            <li>Dynamic and collaborative work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 4,
            'city_id' => 5,
            'seniority_id' => 3,
            'full_time' => true,
            'workplace_id' => 2,
            'company_id' => 2,
            'application_deadline' => '2024-03-15',
            'status' => Job::STATUS_ACTIVE
        ],
        [//Google - C#, SQL, SOAP, REST, .NET Core, Junior
            'name' => 'Support Developer',
            'description' => '<p>Join Google, a global technology leader, as a Support Developer and contribute to the development and maintenance of our cutting-edge software solutions. As a Junior Support Developer, you will have the opportunity to work with a talented team of professionals and gain hands-on experience with technologies such as C#, SQL, SOAP, REST, and .NET Core.</p>',
            'responsibilities' => '<p>As a Junior Support Developer at Google, you will:</p>
        <ul>
            <li>Assist in the development and enhancement of software applications</li>
            <li>Participate in troubleshooting and resolving technical issues reported by users</li>
            <li>Conduct code reviews and assist in ensuring code quality and adherence to best practices</li>
            <li>Collaborate with cross-functional teams to deliver high-quality solutions on time</li>
            <li>Contribute to the documentation and knowledge base for support-related tasks</li>
            <li>Stay updated on emerging technologies and industry trends in software development</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Basic understanding of programming concepts and software development lifecycle</li>
            <li>Proficiency in C# programming language and SQL database querying</li>
            <li>Knowledge of web services technologies such as SOAP and REST</li>
            <li>Familiarity with .NET Core framework and development tools</li>
            <li>Strong problem-solving and analytical skills</li>
            <li>Excellent communication and teamwork abilities</li>
        </ul>',
            'benefits' => '<p>At Google, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on exciting projects with global impact</li>
            <li>Dynamic and collaborative work environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Supportive work culture and opportunities for career growth</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 1,
            'seniority_id' => 1,
            'full_time' => true,
            'workplace_id' => 1,
            'company_id' => 1,
            'application_deadline' => '2024-04-01',
            'status' => Job::STATUS_ACTIVE
        ],
        [//30Hills - SQL, Oracle, PL/SQL, Junior
            'name' => 'Junior Database Developer',
            'description' => '<p>Join 30Hills, a dynamic technology company, as a Junior Database Developer and kick-start your career in database development. In this role, you will have the opportunity to work with a talented team of professionals and gain hands-on experience with technologies such as SQL, Oracle, and PL/SQL.</p>',
            'responsibilities' => '<p>As a Junior Database Developer at 30Hills, you will:</p>
        <ul>
            <li>Assist in the design, development, and maintenance of database systems</li>
            <li>Write and optimize SQL queries for data retrieval and manipulation</li>
            <li>Develop and maintain PL/SQL stored procedures, functions, and triggers</li>
            <li>Participate in database schema design and optimization</li>
            <li>Assist in troubleshooting and resolving database-related issues</li>
            <li>Collaborate with cross-functional teams to deliver database solutions</li>
            <li>Stay updated on emerging technologies and industry trends in database development</li>
        </ul>',
            'requirements' => '<p>We are looking for candidates who have:</p>
        <ul>
            <li>Bachelor’s or Master’s degree in Computer Science, Engineering, or related field</li>
            <li>Basic understanding of database concepts and SQL language</li>
            <li>Knowledge of Oracle database management system</li>
            <li>Understanding of PL/SQL programming language</li>
            <li>Strong problem-solving and analytical skills</li>
            <li>Excellent communication and teamwork abilities</li>
        </ul>',
            'benefits' => '<p>At 30Hills, we offer:</p>
        <ul>
            <li>Competitive salary and benefits package</li>
            <li>Opportunity to work on diverse projects and gain valuable experience</li>
            <li>Supportive work culture and collaborative team environment</li>
            <li>Continuous learning and professional development opportunities</li>
            <li>Potential for career growth within the company</li>
        </ul>',
            'category_id' => 1,
            'city_id' => 1,
            'seniority_id' => 1,
            'full_time' => true,
            'workplace_id' => 1,
            'company_id' => 18,
            'application_deadline' => '2024-04-05',
            'status' => Job::STATUS_ACTIVE
        ]
    ];

    public function run(): void
    {
        foreach ($this->jobs as $job) {
            $job["created_at"] = now();
            Job::create($job);
        }
    }
}
