# WebArt01 WordPress Theme

A custom, responsive WordPress theme built from scratch for **[WebArt01](https://webart01.com/)**, a small-business web design and branding studio. The theme powers a 10-page marketing site with a modern design, a sticky navigation bar, and content that is fully editable from the WordPress dashboard.

**Live site:** [https://webart01.com](https://webart01.com/)

<img width="400" height="734" alt="Image" src="https://github.com/user-attachments/assets/02c52af8-84af-4890-975b-4ce595af9c0c" />

## Features

- **Custom theme**, hand-built with no starter theme or page builder
- **10 pages**: Home, Work, About, Quote, Contact, and five service pages (Website Development, Company Branding, Social Media Marketing, Copywriting, Photography)
- **Fully responsive**, designed mobile-first for phones, tablets, and desktops
- **Sticky navigation bar** with a dropdown Services menu
- **Modern design** styled with Tailwind CSS utility classes
- **Fully editable**: site owners can update page content, images, and text without touching code
- **Contact and quote forms** built with Ninja Forms
- **Automated backups** with UpdraftPlus

## Tech Stack

| Area | Tools |
|---|---|
| Platform | WordPress |
| Languages | PHP, HTML, CSS, JavaScript |
| Styling | Tailwind CSS |
| Custom content | Advanced Custom Fields (ACF) |
| Forms | Ninja Forms |
| Backups | UpdraftPlus |
| Local development | Laravel Herd |

## Screenshots

| Services  | Quote
|---|---|
| <img width="400" height="337" alt="Image" src="https://github.com/user-attachments/assets/ce6ccbf6-8004-4169-81bb-290d80569469" />|<img width="400" height="323" alt="Image" src="https://github.com/user-attachments/assets/836de0bd-aa22-46e1-985e-af7548afbf9d" />

## Theme Structure

```
webart01/
├── style.css          # Theme header and base styles
├── functions.php      # Theme setup, menus, and enqueued scripts/styles
├── header.php         # Site header and sticky navigation
├── footer.php         # Site footer
├── index.php          # Default template
├── page-*.php         # Custom page templates
├── assets/            # CSS, JavaScript, and images
└── screenshots/       # README images
```

> Adjust this tree to match your actual files.

## Required Plugins

This theme works with these plugins:

- [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) for editable custom content fields
- [Ninja Forms](https://wordpress.org/plugins/ninja-forms/) for the contact and quote forms
- [UpdraftPlus](https://wordpress.org/plugins/updraftplus/) for backups (optional)

## Installation

1. Download or clone this repository:
   ```bash
   git clone https://github.com/debralee/webart01-wordpress-theme.git
   ```
2. Copy the folder into your WordPress installation at `wp-content/themes/webart01`.
3. In the WordPress dashboard, go to **Appearance → Themes** and activate **WebArt01**.
4. Install and activate the plugins listed above.
5. Create the pages (Home, Work, About, Quote, Contact, and the service pages) and assign the matching page templates.
6. Set up your menu under **Appearance → Menus**.

## What This Project Demonstrates

- Building a WordPress theme from scratch, including template hierarchy, template parts, and enqueuing assets
- Responsive, utility-first styling with Tailwind CSS
- Making a site easy for non-developers to manage using ACF
- Integrating third-party plugins for forms and backups
- Delivering a complete, live site for a real business

## Author

**Debra Rivera**
- Portfolio site: [webart01.com](https://webart01.com/)
- LinkedIn: [linkedin.com/in/debrarivera](https://linkedin.com/in/debrarivera)

## License

Released under the [MIT License](LICENSE).
