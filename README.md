# Filament & Multi-Tenant Study

A comprehensive Laravel application demonstrating **Filament v5** features, multi-tenancy, roles/permissions, and more.

## Tech Stack

| Technology | Version |
|-----------|---------|
| PHP | 8.4 |
| Laravel | 13 |
| Filament | 5.6 |
| Livewire | 4 |
| Tailwind CSS | 4 |
| Pest | 4 |
| Fortify | 1 |
| Flux UI | 2 |

---

## Table of Contents

### Section 1: How Filament Works

#### 1.1 Install, Create User & Customize
- Installed Filament via `composer require filament/filament`
- Created AdminPanelProvider at `/admin` path
- Enabled login and registration
- Only `admin@gmail.com` can access the panel

#### 1.2 First CRUD Menu: Product Resource
- Created `ProductResource` with name, price, description fields
- Full CRUD: List, Create, Edit pages
- Global redirect after create/edit to index

#### 1.3 Column Sort, Search, and Validate
- `sortable()` on name and price columns
- `searchable(isIndividual: true)` on name column
- Validation rules on form fields (`required`, `numeric`)

#### 1.4 Money Column: Modify Before/After Form
- Price stored as cents (integer * 100)
- `money('EGP', 100)` display format
- Mutated before save (`mutatePropertyBeforeSave`) and after fill (`mutatePropertyAfterFill`)

### Section 2: Select Fields and Relationships

#### 2.1 Select Dropdown with/without belongsTo
- `Select::make('category_id')->relationship('category', 'name')` for category selection

#### 2.2 Selecting From a Table Modal
- `ModalTableSelect` with reusable `CategoriesTable` configuration

#### 2.3 Generate Simple Resources and hasMany Count
- `CategoryResource` as simple resource (ManageRecords page)
- `products_count` column using `->counts('products')`
- `TagResource` as simple resource

#### 2.4 BelongsToMany: Multi-Select and Relation Managers
- `Select::make('tags')->multiple()->relationship('tags', 'name')`
- `TagsRelationManager` on ProductResource for managing many-to-many tags

### Section 3: Customizing Tables

#### 3.1 Table Filters for Select and Dates
- `SelectFilter` for status and category
- Date range filter with `created_from` / `created_until`
- Filters layout: `AboveContent`

#### 3.2 Column Formatting: Badges, URLs, Labels, Alignment, Dates
- `badge()` for tags and status
- `since()` for relative dates
- `money()` for price formatting
- Custom labels via `->label()`

#### 3.3 Table Columns for Live-Editing Data
- `SelectColumn` for inline status editing
- `ToggleColumn` for inline is_active toggling

#### 3.4 Table Grouping and Summarizers
- `defaultGroup('product.name')` on Orders table
- `summarize(Average::make())` on price column

#### 3.5 Table Actions: Row / Bulk / Header
- **Row actions**: "Mark as Featured" on Products, "Duplicate Order" on Orders
- **Bulk actions**: "Toggle Active Status" on Products, "Delete Selected" on Orders
- **Header actions**: "Export Report" on Products
- Notifications on action completion
- Confirmation modals on destructive actions

### Section 4: Customizing Look & Feel

#### 4.1 Form Layouts: Columns, Sections, Tabs, Wizards
- **Tabs**: Product form organized into 3 tabs - Basic Information, Relationships, Settings
- **Sections**: Grouped fields with descriptions inside tabs
- **Columns**: Responsive 2-column grid layout in tabs
- **Order form**: Section layout with searchable Select fields

#### 4.2 Menu Items: Ordering, Grouping, Icons, Badges
- **Navigation group**: All resources under 'Shop' group
- **Sort order**: Products (1), Orders (2), Categories (3), Tags (4)
- **Icons**: ShoppingBag, ShoppingCart, Tag, Bookmark
- **Badge**: Active product count badge on Products resource
- **User menu**: Custom "Settings" menu item

#### 4.3 Change Colors, Fonts, Themes
- **Colors**: Amber (primary), Green (success), Orange (warning), Rose (danger), Blue (info), Slate (gray)
- **Font**: Inter
- **Brand name**: 'Shop Admin'
- **Accountant panel**: Blue color scheme

#### 4.4 Multi-language: System Texts, Labels, Menus
- Published Filament translations via `vendor:publish`
- Customized English button labels (save, cancel, delete, create, edit, view)
- Support for 50+ locale languages

### Section 5: More Filament Features

#### 5.1 View Pages: Custom Page or Infolist Builder
- `ViewProduct` page with Infolist entries
- Displays product details with `TextEntry`, `IconEntry`
- View action in products table

#### 5.2 Global Search in Multiple Resources
- `GloballySearchable` interface on Product and Order models
- `getGloballySearchableAttributes()` for name, category.name, price
- `getGlobalSearchResultDetails()` for extra info in search results

#### 5.3 Dashboard Widgets: Stats, Charts, Tables and Header/Footer
- **StatsOverviewWidget**: Total Products, Total Orders, Active Products, Total Categories
- **LatestOrdersWidget**: Table of latest 5 orders
- **ProductChartWidget**: Line chart of products created per month

#### 5.4 Dynamic Forms: Hidden, Disabled and "Reactive" Options
- Hidden `user_id` field defaulting to `auth()->id()`
- Reactive `release_notes` textarea (visible only when status='coming soon')
- Disabled `release_date` datepicker when status is not 'coming soon'
- Migration for new columns

#### 5.5 Custom Data from API
- `ApiDataPage` fetching from JSONPlaceholder API
- Fetch Data action with loading state
- Response displayed in a formatted table

#### 5.6 Nested Resources
- `ProductsRelationManager` under CategoryResource
- Shows products belonging to each category
- EditCategory page for proper relation manager display

#### 5.7 Multi-Factor Authentication
- Filament MFA with Google Authenticator-compatible app
- `app_authentication_secret` and recovery codes columns
- `HasAppAuthentication` interface on User model
- Profile page with MFA setup UI
- Recovery codes for account recovery

### Section 6: Roles and Permissions

#### 6.1 Restrict Add/Edit/Delete Actions and Buttons
- **ProductPolicy**: Only admin users can create/update/delete
- **OrderPolicy**: Access control for order management
- Policies registered in `AppServiceProvider`
- `->visible()` and `->authorize()` on actions

#### 6.2 Multi-Tenancy in Filament
- `HasTenants` interface on User model
- Team-based tenancy via existing `teams()` relationship
- `tenant(Team::class)` configuration
- **RegisterTeam** page for creating new teams
- **EditTeamProfile** page for team profile editing
- URL slug-based team identification

#### 6.3 Multiple Panels: Admin and Accountant
- **Admin panel** (`/admin`): Full access with all resources
- **Accountant panel** (`/accountant`): Read-only Orders access
- Separate PanelProvider classes
- Different branding and color schemes
- `canAccessPanel()` controls panel access per user

#### 6.4 Shield Plugin for Roles and Permissions
- Installed `bezhansalleh/filament-shield`
- Published config and migrations
- Super Admin role for `admin@gmail.com`
- `HasRoles` trait on User model (with conflict resolution for `teams()`)
- `FilamentShieldPlugin` registered in AdminPanelProvider

---

## Filament Resources

| Resource | Type | Features |
|----------|------|----------|
| **Products** | Full CRUD + View | Tabs form, Infolist, Global Search, Widgets, Dynamic fields |
| **Orders** | Full CRUD | Grouping, Summarizers, Custom actions, Nested display |
| **Categories** | Simple (ManageRecords) | hasMany count, Nested Products relation manager |
| **Tags** | Simple (ManageRecords) | BelongsToMany relationship |

## Panels

| Panel | Path | Access | Resources |
|-------|------|--------|-----------|
| Admin | `/admin` | admin@gmail.com | Products, Orders, Categories, Tags, API Data, Widgets |
| Accountant | `/accountant` | All users (read-only) | Orders (read-only) |

## Dashboard Widgets

- **StatsOverviewWidget**: 4 stat cards
- **LatestOrdersWidget**: Latest 5 orders table
- **ProductChartWidget**: Monthly product creation chart

## Installation

```bash
# Clone the repository
git clone https://github.com/mohamedelmasry199/filament-and-multi-tenant-.git
cd filament-and-multi-tenant-study

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Create admin user
php artisan filament:make-user

# Install Shield
php artisan shield:install
php artisan shield:super-admin

# Start development server
composer run dev
```

## Testing

```bash
# Run all tests
php artisan test --compact

# Run specific test file
php artisan test --compact --filter=ProductTest
```

## Code Quality

```bash
# Format code
vendor/bin/pint --format agent

# Static analysis
vendor/bin/phpstan analyse
```
