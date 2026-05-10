# BizGathers | Online Directory & SME Hub
**Project**: Website Wireframe & Functional Mockup  
**Stack**: Vue (JavaScript) + Tailwind CSS (v4) + GSAP  
**Brand colors**: `#f1c617` (primary) · `#161315` (dark/base)

---

## Local Development
The Vue + Tailwind site lives in `BizGathers/web/`.

```bash
cd BizGathers/web
npm install
npm run dev
```

Build for production:

```bash
cd BizGathers/web
npm run build
```

---

## WordPress MVP (Option A: Block Theme + Real Business CPT)
This repo also includes a WordPress **block theme** (Full Site Editing) that implements the MVP as:
- A real **Business custom post type**
- **Category** + **Location** taxonomies
- A Directory page with real **filters** (search/category/location/verified/min rating)

### Theme location
`BizGathers/wordpress/wp-content/themes/bizgathers/`

### Install (local)
- Set up a local WordPress install (LocalWP / XAMPP / Laragon).
- Copy the theme folder into your WordPress install:
  - `wp-content/themes/bizgathers`
- In WP Admin:
  - **Appearance → Themes → Activate** “BizGathers”

### Create data
- WP Admin → **Businesses** → Add New
- Set:
  - Title + description/excerpt
  - Featured image (optional)
  - Categories + Locations (taxonomies)
  - “Business Details” meta box (phone/address/facebook/rating/verified)

### Directory page (with filters)
1. Create a page named **Directory**
2. In the page editor, set **Template** to **Directory** (from the template dropdown)
3. The directory renders via shortcode:
   - `[bizgathers_directory]`

### Home page
Create a page named **Home** and set **Template** to **Home**.

> Note: We can later upgrade the directory filters into a native Gutenberg block,
> but the shortcode is the fastest working MVP.

---

## Current Implementation (What’s Built)
- **Pages (routes)**
  - **Home**: `/`
  - **Directory**: `/directory`
  - **Business Profile**: `/business/:id`
  - **Campaigns**: `/campaigns`
  - **About**: `/about`
  - **Pricing**: `/pricing`
  - **Support**: `/support`
  - **Blog / Stories**: `/blog`
- **Branding**
  - **Navbar logo**: `BizGathers/web/src/assets/brand/Logo.png`
  - **Hero logo**: `BizGathers/web/src/assets/brand/BigLogo.png`
  - **Preloader logo**: `BizGathers/web/src/assets/brand/LogoNoBG.png`
- **Social**
  - **Facebook page**: `https://www.facebook.com/bizgathers`
- **Theme system**
  - **Light/Dark mode** with saved preference (`localStorage` key: `bizgathers-theme`)
  - **Circular reveal toggle animation** (View Transitions API with graceful fallback)
  - Theme tokens live in `BizGathers/web/src/style.css`
- **Loading screen**
  - Preloader overlay in `BizGathers/web/index.html`
  - Fade-out + minimum visible duration in `BizGathers/web/src/main.js`
- **Animations**
  - GSAP + ScrollTrigger “majestic” motion system (intro + scroll reveals)
  - Motion code: `BizGathers/web/src/composables/useMajesticMotion.js`
  - Reduced motion respected: `BizGathers/web/src/utils/motion.js`
- **Performance baseline**
  - rAF throttling helper: `BizGathers/web/src/utils/rafThrottle.js`
  - Global scroll hook in `BizGathers/web/src/App.vue`

---

## Platform Strategy
- **Goal**: A centralized online directory for small-to-medium enterprises (SMEs).
- **Core value**: Bridge the gap between social media discovery (Facebook) and professional business listings.
- **Total pages**: 8  
- **Total sections**: 26

---

## Pages & Sections

### 1) Homepage (4 sections)
Entry point designed to convert casual visitors into searchers or members.

1. **Hero section**
   - **Visual**: High-res image of local business owners or a community “gathering.”
   - **Action**: Centered search bar (Service Type | Location | Search Button).
   - **Tagline**: “Where Local Business Grows Together.”
2. **Featured campaigns (grid/carousel)**
   - Cards showing “Trending Now” promos pulled directly from Facebook campaigns.
3. **BizGathers CTA**
   - Dual-track button: **[Get Listed — It’s Free]** | **[Discover Local Gems]**
4. **Community footer**
   - **Contact**: Phone/Email
   - **Socials**: Direct links to `@BizGathers` Facebook/Instagram
   - **Newsletter**: “Stay updated on the next community gather.”

---

### 2) Directory (3 sections)
The high-utility search engine of the site.

1. **Sidebar filters**
   - **Categories**: F&B, Retail, Services, Tech, Healthcare
   - **Proximity**: “Within 5km,” “Neighborhood-specific”
   - **Trust score**: Filter by 4+ star ratings
2. **Main listings (the feed)**
   - **Toggle**: Switch between “Map View” and “Gallery View”
   - **Card info**: Business Name, Badge (Free/Premium), Category, and “Distance from you”
3. **Premium highlight**
   - Top-row “Spotlight” businesses with larger thumbnails and a “Verified by BizGathers” badge

---

### 3) Business Profiles (4 sections)
The “mini-website” for every listed SME.

1. **Header**
   - Brand logo, cover photo (consistent with Facebook branding), and a “Messenger” button for direct chat
2. **Interactive tabs**
   - **Overview** (NAP: Name, Address, Phone)
   - **Story** (the founder’s journey)
   - **Promotions** (live offers)
   - **Analytics** (owner-view: number of “Get Directions” clicks)
3. **Story section**
   - Narrative text + “Behind the Scenes” photo gallery
4. **Active promo section**
   - Specific deal cards with “Claim Now” buttons that redirect to a landing page or voucher

---

### 4) Campaigns (3 sections)
The platform’s engine for seasonal growth.

1. **Seasonal banner**
   - Full-width dynamic banner (e.g., “Ramadan Specials,” “Christmas Gathers”)
2. **Campaign grid**
   - Aggregation of all businesses participating in the current theme
3. **SME growth CTA**
   - “Launch your campaign on BizGathers. Reach 10k+ local users.”

---

### 5) About Us (3 sections)
Humanizing the directory.

1. **Mission & vision**
   - “Empowering SMEs through digital visibility and community support.”
2. **Story of BizGathers**
   - How the platform started (originating from the Facebook community)
3. **Team & partnerships**
   - Photos of the team and logos of supporting local organizations

---

### 6) Pricing & Subscription (3 sections)
Monetization and business onboarding.

1. **Free tier details**
   - Basic profile listing, standard search ranking
2. **Premium tiers (Silver/Gold)**
   - Priority ranking, “Featured” status, social media shoutouts
3. **Upsell packages**
   - “Storytelling Package” (professional photoshoot + written feature)

---

### 7) Support (3 sections)
Customer success and retention.

1. **Merchant FAQs**
   - “How do I claim my listing?”
   - “How to track analytics?”
2. **Contact form**
   - Dedicated support for business owners
3. **Merchant SOPs**
   - Downloadable PDF guides for onboarding, campaign setup, and subscription renewals

---

### 8) Blog / Stories (3 sections)
The SEO and engagement engine.

1. **SME success stories**
   - Interviews with business owners who grew using the directory
2. **Digital marketing tips**
   - “How to use Facebook to drive traffic to your BizGathers profile.”
3. **Community impact**
   - Spotlighting local charities or neighborhood events

---

## UI/Brand Notes (for Tailwind)
- **Primary**: `#f1c617`
- **Base/Dark**: `#161315`
- **Suggested usage**
  - Buttons/accents: primary on dark background
  - Background: dark/base with off-white content areas as needed
  - Badges (Free/Premium/Verified): keep high contrast for accessibility

---

## Brand Assets (images)
Logos are stored in `BizGathers/images/`.
The Vue app uses copies in `BizGathers/web/src/assets/brand/` for bundling.

- **Hero (BigLogo)**: `images/BigLogo.png`
- **Navbar (logo)**: `images/Logo.png`
- **X-icon (LogoNoBG)**: `images/LogoNoBG.png`

---

## Future Plans
- **Directory data**
  - Replace mock listings with real data (API + database)
  - Business claiming flow + owner dashboard (analytics/promotions)
- **Maps**
  - Real map provider integration (Google Maps / Mapbox) for “Map View”
  - Geolocation + distance calculations
- **Search & ranking**
  - Full-text search, category facets, proximity filters, trust score weighting
  - Premium spotlight placement rules
- **Auth & subscriptions**
  - Merchant authentication + role-based access
  - Subscription plans + payments (Silver/Gold)
- **SEO & performance**
  - Metadata per page, sitemap/robots, OpenGraph
  - Image optimization + route-level code splitting where appropriate
- **QA/testing**
  - Responsive testing checklist (mobile/tablet/desktop)
  - Accessibility checks (focus states, contrast, reduced motion)
