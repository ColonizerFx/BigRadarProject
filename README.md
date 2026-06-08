# [cite_start]PROJECT PROPOSAL GUIDELINES [cite: 320]
### [cite_start]BIIT 2305 [cite: 321]
### [cite_start]PROPOSAL FOR PROJECT DEVELOPMENT [cite: 322]
### [cite_start]BigRadar: Centralized PC Component Locator & Marketplace [cite: 323]
### [cite_start]GROUP 2 [cite: 324]

| NAME | MATRIC NO. |
| :--- | :--- |
| HARITS DANISH BIN MOHD FAIRUZ | [cite_start]2417417 | [cite: 325]
| DANISH ISKANDAR BIN MUHAMMAD ANNUAR | [cite_start]2418095 | [cite: 325]
| MOHAMAD AZRELL HAFIZY BIN A HAMID | [cite_start]2418013 | [cite: 325]
| MOHAMAD AFFIF AFIQ BIN MOHD AFFENDI | [cite_start]2415445 | [cite: 325]
| DANIEL HAQIMI BIN MUHAMAD KAMAL | [cite_start]2318163 | [cite: 325]

---

## [cite_start]PROPOSAL FOR PROJECT DEVELOPMENT [cite: 326]

### 1.1 INTRODUCTION
[cite_start]The proposed project is a web-based application, BigRadar, developed using the Laravel Model-View-Controller (MVC) framework. [cite: 328] [cite_start]BigRadar is a centralized hardware aggregator designed specifically for the niche market of PC builders, hardware enthusiasts, and gamers. [cite: 329] [cite_start]The application's criteria include a centralized dashboard featuring a cross-retailer search engine, dynamic price comparison, and a peer-to-peer (P2P) secondhand marketplace. [cite: 330] [cite_start]The system features full CRUD (Create, Read, Update, Delete) capabilities, allowing users to manage their marketplace listings, alongside an integrated search function to locate PC components effectively across multiple official retailers. [cite: 331]

### 1.2 PROBLEM DESCRIPTION

[cite_start]**1.2.1 Background of the problem** [cite: 333]
[cite_start]The application will be developed and deployed as a web application. [cite: 334] [cite_start]Currently, consumers looking to build or upgrade a PC must manually search across fragmented platforms. [cite: 335] [cite_start]They are forced to visit individual official retailer websites (such as All IT Hypermarket, Harvey Norman, and TMT) to check component availability and pricing. [cite: 336] [cite_start]This environment leads to inefficient data retrieval and a highly frustrating consumer experience when comparing prices. [cite: 337] [cite_start]Furthermore, if users want to buy or sell used parts, they must navigate to entirely separate platforms (like eBay or local forums) that lack integration with official retail pricing. [cite: 338]

[cite_start]**1.2.2 Problem Statement** [cite: 339]
[cite_start]The specific problems with existing consumer processes that this application will automate and enhance include: [cite: 340]
* [cite_start]Fragmented searching requires users to manually switch between multiple disconnected retailer websites to compare prices. [cite: 341]
* [cite_start]Lack of a centralized platform makes it difficult to search for specific hardware models, check real-time stock, and find the closest physical store locations quickly. [cite: 342]
* [cite_start]There is no unified platform that allows consumers to survey official brand-new retail prices and local secondhand marketplace listings simultaneously. [cite: 343]

### 1.3 PROJECT OBJECTIVE
[cite_start]The primary objective is to develop a unified web application that streamlines PC component surveying and purchasing under a single dashboard. [cite: 345]
* [cite_start]**Reports Produced:** At the end of the project, the system will produce consolidated view reports (data tables) of searched hardware, displaying aggregated pricing and availability from partnered retailers and user listings. [cite: 346]
* [cite_start]**Processes Automated:** The processes that will be automated include real-time search functionality to filter hardware data, seamless CRUD operations for users to manage their P2P marketplace listings, and automated sorting algorithms that compare prices across different vendors. [cite: 347]

### 1.4 PROJECT SCOPE

[cite_start]**1.4.1 Scope** [cite: 349]
[cite_start]The scope of BigRadar covers the backend database management and frontend user interface for three main operational modules: the Cross-Retailer Search Engine, the Price Comparison Module, and the Peer-to-Peer Marketplace Inventory. [cite: 350]

[cite_start]**1.4.2 Targeted User** [cite: 351]
[cite_start]The target users encompass PC builders, hardware enthusiasts, and gamers looking to source components, as well as private sellers looking to trade in or sell their used PC parts. [cite: 352]

[cite_start]**1.4.3 Specific Platform** [cite: 353]
[cite_start]The infrastructure required for development and execution involves XAMPP (Apache web server and MySQL database via phpMyAdmin) acting as the local server environment. [cite: 354] [cite_start]The application is built on the Laravel PHP framework utilizing Tailwind CSS for the frontend. [cite: 355] [cite_start]Because the project relies entirely on open-source web technologies, there are no specific hardware limitations; [cite: 356] [cite_start]users only require a standard web browser to access the system. [cite: 357]

### 1.5 CONSTRAINTS
[cite_start]The major constraints foreseen for this project development include: [cite: 359]
* [cite_start]**Time constraints:** The development, testing, and debugging phases must be rigorously scheduled to ensure completion within the academic semester timeline. [cite: 360]
* [cite_start]**Technical Learning Curve:** Adapting to Laravel's MVC architecture, mastering complex database queries for the search aggregator, and handling Tailwind CSS compilation requires significant initial research and troubleshooting. [cite: 361]

### 1.6 PROJECT STAGES
[cite_start]The major milestones for the project development are as follows: [cite: 363]
* [cite_start]**Phase 1:** Project Proposal & Requirements Gathering. [cite: 364]
* [cite_start]**Phase 2:** Database Design & Migrations (Structuring Users, Retailers, and Component Listings tables). [cite: 365]
* [cite_start]**Phase 3:** MVC Backend Setup (Establishing Models, Routing, and Resource Controllers). [cite: 366]
* [cite_start]**Phase 4:** Frontend Interface Development (Blade views, Forms, Dashboard integration). [cite: 367]
* [cite_start]**Phase 5:** System Testing (Validating search functionality, sorting algorithms, error handling, and finalizing the project report). [cite: 368]

### 1.7 SIGNIFICANCE OF THE PROJECT
[cite_start]The benefits of this project for the targeted users include: [cite: 370]
* [cite_start]**Consumers/Buyers:** Greatly reduces the time and effort required to build a PC by centralizing price comparisons and stock availability into a single, easily navigable digital dashboard. [cite: 371]
* [cite_start]**Private Sellers:** Provides a dedicated, niche marketplace to list used components directly alongside retail prices, ensuring fair market value and visibility among targeted enthusiasts. [cite: 372]

### 1.8 FEATURES AND FUNCTIONALITIES
[cite_start]Based on the project requirements and RigRadar proposal, here are the core features and functionalities: [cite: 374]
* [cite_start]**Centralized Hardware Dashboard:** The system provides a single, unified interface for users to search for PC components without switching between disconnected retail systems. [cite: 375]
* [cite_start]**Cross-Retailer Search Functionality:** The system features real-time search capabilities to quickly filter hardware data and locate specific models across different official stores. [cite: 376]
* [cite_start]**Dynamic Price Comparison:** Automated comparison tables that rank components by price and highlight real-time stock availability. [cite: 377]
* [cite_start]**P2P Marketplace Module:** Users can perform complete CRUD (Create, Read, Update, Delete) operations to digitally manage and maintain their own secondhand part listings. [cite: 378]
* [cite_start]**Secure User Authentication (Consumers & Sellers):** The application features a secure user login system to ensure that PC builders and hardware enthusiasts can safely manage their personal profiles, price-comparison wishlists, and secondhand marketplace inventory. [cite: 379]
* [cite_start]**Automated Database Validation:** To ensure high data integrity across both the official retail aggregator and the P2P marketplace, the system utilizes strict validation rules. [cite: 380] [cite_start]These rules automatically trigger error alerts and prevent duplicate entries, such as identical secondhand listing submissions by a user or duplicate retail SKU (Stock Keeping Unit) registrations. [cite: 381]
* [cite_start]**Secure Administrative Access:** A strict, role-based authentication portal ensures that only authorized retail partners and system administrators can access, manage, and modify official store inventories and overarching platform data. [cite: 382]
* [cite_start]**Shariah-Compliant E-Commerce Practices:** All features, marketplace interactions, and data management practices will be developed in accordance with Shariah principles. [cite: 383] [cite_start]This includes enforcing transparent price comparisons without hidden fees or deception (Gharar), prohibiting the trade of stolen or illicit hardware in the P2P market, and maintaining fair, ethical peer-to-peer trading guidelines. [cite: 384]

#### [cite_start]1.8.1 Entity-Relationship Diagram (ERD) [cite: 385]
```mermaid
erDiagram
    users ||--o{ marketplace_listings : "lists items"
    users ||--o{ user_reviews : "writes"
    users ||--o{ transactions : "buys items"
    categories ||--o{ marketplace_listings : "classifies"
    categories ||--o{ retail_components : "classifies"
    retailers ||--o{ retail_components : "provides"
    marketplace_listings ||--o{ user_reviews : "receives"
    marketplace_listings ||--o| transactions : "results in"

    users {
        BIGINT_UNSIGNED id PK
        VARCHAR name
        VARCHAR email "UNIQUE"
        VARCHAR password
        ENUM role "'consumer', 'seller', 'admin'"
        TIMESTAMP email_verified_at
        TIMESTAMP created_at
        TIMESTAMP updated_at
    }
    categories {
        INT_UNSIGNED id PK
        VARCHAR name
        VARCHAR slug "UNIQUE"
    }
    retailers {
        BIGINT_UNSIGNED id PK
        VARCHAR name
        VARCHAR api_endpoint
        VARCHAR support_email
    }
    marketplace_listings {
        BIGINT_UNSIGNED id PK
        BIGINT_UNSIGNED seller_id FK
        INT_UNSIGNED category_id FK
        VARCHAR title
        TEXT description
        DECIMAL asking_price
        ENUM condition "'new', 'used'"
        ENUM status "'active', 'sold', 'hidden'"
        TINYINT is_shariah_compliant
        TIMESTAMP created_at
    }
    retail_components {
        BIGINT_UNSIGNED id PK
        BIGINT_UNSIGNED retailer_id FK
        INT_UNSIGNED category_id FK
        VARCHAR sku_code "UNIQUE"
        VARCHAR component_name
        DECIMAL base_price
        INT stock_quantity
        TIMESTAMP last_synced_at
    }
    user_reviews {
        BIGINT_UNSIGNED id PK
        BIGINT_UNSIGNED reviewer_id FK
        BIGINT_UNSIGNED listing_id FK
        TINYINT rating "1-5"
        TEXT comment
        TIMESTAMP created_at
    }
    transactions {
        BIGINT_UNSIGNED id PK
        BIGINT_UNSIGNED listing_id FK
        BIGINT_UNSIGNED buyer_id FK
        DECIMAL final_price
        ENUM payment_status "'pending', 'completed', 'failed'"
        TIMESTAMP transaction_date
    }
```

#### [cite_start]1.8.2 Activity Sequence Diagram [cite: 439]
```mermaid
sequenceDiagram
    actor User
    participant View as Search.blade.php<br/>(View)
    participant Controller as SearchController<br/>(Controller)
    participant Validator as Validator<br/>(Laravel Request)
    participant RetailModel as RetailComponent<br/>(Model)
    participant MarketModel as MarketListing<br/>(Model)
    participant DB as MySQL Database

    User->>View: 1 Enter query "RTX 4060" & Submit
    View->>Controller: 2 GET /search?q=RTX+4060
    
    Note over Controller,Validator: 1. Security & Validation
    Controller->>Validator: 3 validate(['q' => 'required|string|max:100'])
    Validator->>Validator: 4 Sanitize inputs (Prevent SQLi/XSS)
    alt Validation Failed
        Validator-->>Controller: 5 Return Error Messages
        Controller-->>View: 6 Redirect back with errors
        View-->>User: 7 Display "Invalid Search Term"
    else Validation Passed
        Validator-->>Controller: 8 Validated Data
    end

    Note over Controller,DB: 2. Database Queries
    par Execute Queries Concurrently
        Controller->>RetailModel: 9 where('name', 'LIKE', '%RTX 4060%')
        RetailModel->>DB: 10 SELECT * FROM retail_components
        DB-->>RetailModel: 11 Retail Results
        RetailModel-->>Controller: 12 Retail Collection
    and
        Controller->>MarketModel: 13 where(['status => active', is_shariah_compliant => true])
        MarketModel->>DB: 14 SELECT * FROM marketplace_listings
        DB-->>MarketModel: 15 P2P Results
        MarketModel-->>Controller: 16 P2P Collection
    end

    Note over Controller,View: 3. Data Processing
    Controller->>Controller: 17 Merge Collections
    alt No Results Found
        Controller-->>View: 18 Return empty state view
        View-->>User: 19 Display "No components found."
    else Results Found
        Controller->>Controller: 20 Remove identical P2P duplicate listings
        Controller->>Controller: 21 Sort Collection by 'price' (ASC)
        Controller-->>View: 22 Return unified $results to Blade
        View-->>User: 23 Render interactive price comparison dashboard
    end
```

### 1.9 SUMMARY
[cite_start]In summary, BigRadar is a comprehensive MVC-based web application engineered to solve the inefficiencies of fragmented PC hardware sourcing. [cite: 488] [cite_start]By unifying cross-retailer search capabilities, dynamic price comparisons, and a secure, Shariah-compliant peer-to-peer marketplace into a single intuitive dashboard, the platform empowers enthusiasts to make data-driven purchasing decisions. [cite: 489] [cite_start]Ultimately, BigRadar streamlines the component sourcing process, ensures high data integrity through strict system validation, and provides a transparent, localized, and highly efficient e-commerce experience for both consumers and private sellers. [cite: 490]

### 2.0 REFERENCES
1. Apache Friends. (n.d.). XAMPP installers and downloads. [cite_start]Retrieved from https://www.apachefriends.org [cite: 492]
2. Mozilla. (n.d.). MVC - MDN Web Docs Glossary. [cite_start]Retrieved from https://developer.mozilla.org/en-US/docs/Glossary/MVC [cite: 493]
3. OpenJS Foundation. (n.d.). Node.js documentation. [cite_start]Retrieved from https://nodejs.org/en/docs/ [cite: 494]
4. Oracle Corporation. (n.d.). MySQL documentation. [cite_start]Retrieved from https://dev.mysql.com/doc/ [cite: 495, 496]
5. The PHP Group. (n.d.). PHP: Hypertext Preprocessor documentation. [cite_start]Retrieved from https://www.php.net/docs.php [cite: 497, 498]
6. Laravel. (n.d.). Laravel Documentation. [cite_start]Retrieved from https://laravel.com/docs [cite: 499]
7. Tailwind Labs. (n.d.). Tailwind CSS Documentation. [cite_start]Retrieved from https://tailwindcss.com/docs [cite: 500, 501]