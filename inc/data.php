<?php
/*
 * Site content. Edit text here rather than inside page templates.
 */

$COMPANY = [
	'name'      => 'Lanka Special Steels Limited',
	'short'     => 'Lanka SSL',
	'tagline'   => 'Trusted Name in Steels',
	'parent'    => 'A subsidiary of E.B. Creasy & Co. PLC',
	'phone'     => '+94 11 771 5300',
	'phone_all' => '+94 11 771 5300-3',
	'email'     => 'sales@lankassl.com',
	'facebook'  => 'https://www.facebook.com/LankaSpecialSteelsLimited',
	'linkedin'  => 'https://www.linkedin.com/company/6755348/',
];

$LOCATIONS = [
	[
		'label'   => 'Corporate Office',
		'address' => '53A, Ward Place, Colombo 07, Sri Lanka',
		'tel'     => ['+94 11 771 5300-3', '+94 11 493 2416'],
		'fax'     => '+94 11 269 6148',
		'email'   => 'sales@lankassl.com',
		'map'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10822.062174940558!2d79.86978741393571!3d6.9194600192890245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25974702bc19d%3A0xaefb60e42e63ad37!2sLanka%20Special%20Steels%20Ltd!5e0!3m2!1sen!2slk!4v1709176421515!5m2!1sen!2slk',
		'link'    => 'https://maps.google.com/?q=Lanka+Special+Steels+Ltd+Ward+Place+Colombo',
	],
	[
		'label'   => 'Factory',
		'address' => 'LINDEL, Pattiwilla Road, Makola, Sapugaskanda, Sri Lanka',
		'tel'     => ['+94 11 433 5374'],
		'fax'     => '+94 11 240 0898',
		'email'   => 'sales@lankassl.com',
		'map'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.419165509613!2d79.9490373!3d6.9597802999999985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae257b93f5d2f6d%3A0x449b2987dbe21d31!2sLanka%20Special%20Steels%20Factory!5e0!3m2!1sen!2slk!4v1709200520836!5m2!1sen!2slk',
		'link'    => 'https://maps.google.com/?q=Lanka+Special+Steels+Factory+Sapugaskanda',
	],
];

$SALES_CONTACT = ['name' => 'Mr. W. P. Chinthaka Gayan', 'role' => 'Head of Sales & Marketing', 'mobile' => '+94 77 393 6928'];

$STANDARDS = ['SLS 139:2003', 'SLS 31:1988', 'IS 280:2006 · BIS', 'ISO 9001:2015', 'ISO 45001:2018'];

/* ------------------------------------------------------------------ */
/* Products                                                           */
/* ------------------------------------------------------------------ */

$PRODUCTS = [
	'hot-dipped-gi-wire' => [
		'name'     => 'Hot-Dipped Galvanized Iron Wire',
		'short'    => 'Hot-Dipped GI Wire',
		'badge'    => 'Flagship',
		'family'   => 'Galvanized Wire',
		'image'    => 'products/gi-wire.webp',
		'gallery'  => ['products/gi-wire-coil.webp', 'products/gi-wire-160.webp', 'products/gi-coils.webp'],
		'lead'     => 'Premium-grade fencing wire with a superior zinc-alloy bond — our flagship product and the benchmark for galvanized wire in Sri Lanka.',
		'overview' => [
			'Manufactured through a rigorously controlled process of precision wire drawing, advanced heat treatment and continuous hot-dip galvanizing, our GI wire forms a superior zinc-alloy bond between the high-quality steel core and its protective coating. The result is exceptional durability and markedly better corrosion resistance than conventional electroplated wire.',
			'It is produced in a state-of-the-art hot-dip galvanizing facility using Canadian and European technology, and has earned acceptance in demanding export markets including Canada and India, where it serves poultry cage and fencing applications.',
		],
		'specs' => [
			'Diameter'      => '1.20 – 5.00 mm',
			'Zinc coating'  => 'Up to 400 g/m²',
			'Customisation' => 'Tensile strength & coil weight',
			'Standards'     => 'SLS 139:2003 · IS 280:2006',
		],
		'highlights' => [
			'Continuous hot-dip galvanizing — not electroplated',
			'Canadian & European galvanizing technology',
			'Accepted in export markets: Canada & India',
			'Produced under ISO 9001:2015 and ISO 45001:2018',
		],
		'stock' => [
			'title' => 'Popular stock sizes',
			'head'  => ['Diameter', 'Coil weight'],
			'rows'  => [['1.60 mm', '20 – 35 kg'], ['2.00 / 2.50 / 3.00 / 4.00 mm', '20 – 35 kg'], ['3.50 / 5.00 mm', '50 – 75 kg']],
		],
		'applications' => ['Fencing', 'Barbed wire production', 'Cable armouring', 'Chain link fencing', 'Elephant fencing', 'Gabion boxes', 'Welded mesh', 'GI nails', 'Agriculture', 'Slope stabilisation'],
		'spec_tables' => ['commercial', 'heavy'],
	],
	'nail-wire' => [
		'name'     => 'Nail Wire',
		'short'    => 'Nail Wire',
		'badge'    => 'Cold Drawn & Annealed',
		'family'   => 'Drawn Wire',
		'image'    => 'products/nail-wire.webp',
		'photo'    => true,
		'gallery'  => ['products/nail-wire-2.webp'],
		'lead'     => 'Precision cold-drawn mild steel wire with dependable mechanical properties — the raw material behind nails, mesh and reinforcement.',
		'overview' => [
			'Our nail wire is drawn from high-quality mild steel wire rods using premium German wire-drawing technology, delivering consistent dimensional accuracy, a superior surface finish and dependable mechanical properties.',
			'For applications that need softer, more ductile wire, we also offer annealed nail wire produced through a continuous annealing process — improving formability without compromising material integrity.',
		],
		'specs' => [
			'Diameter'   => '1.20 – 6.00 mm',
			'Process'    => 'Cold drawn · Continuous annealed',
			'Technology' => 'German wire drawing',
			'Supply'     => 'Tailored to customer requirement',
		],
		'highlights' => [
			'Consistent dimensional accuracy and surface finish',
			'Dimensions and mechanical properties tailored to order',
			'Annealed option for high-formability applications',
		],
		'applications' => ['Wire nail manufacturing', 'BRC mesh', 'Concrete pole reinforcement', 'General construction', 'Hangers', 'Industrial racks'],
		'spec_tables' => ['nail'],
	],
	'barbed-wire' => [
		'name'     => 'Galvanized Iron Barbed Wire',
		'short'    => 'GI Barbed Wire',
		'badge'    => 'SLS 31 Certified',
		'family'   => 'Fencing',
		'image'    => 'products/barbed-wire.webp',
		'gallery'  => ['products/barbed-wire-pack.webp'],
		'lead'     => 'The only SLS 31:1988 certified GI barbed wire made in Sri Lanka from our own SLS 139 galvanized wire — in one integrated facility.',
		'overview' => [
			'Lanka SSL is the only manufacturer in Sri Lanka producing GI barbed wire certified under SLS 31:1988 while also manufacturing its core galvanized wire to SLS 139:2003 within a single integrated facility. This vertically integrated approach gives us end-to-end quality control and complete traceability at every stage.',
			'Collaborative research with the University of Moratuwa has demonstrated a service life exceeding 15 years. Marketed under the trusted LAXAPANA brand, our barbed wire leads the domestic market and is exported to India.',
		],
		'specs' => [
			'Standard'     => 'SLS 31:1988',
			'Core wire'    => 'SLS 139:2003 GI wire',
			'Service life' => '15+ years (University of Moratuwa)',
			'Brand'        => 'LAXAPANA',
		],
		'highlights' => [
			'Fully integrated: galvanizing to barbed wire under one roof',
			'Complete traceability across every production stage',
			'Proven service life of more than 15 years',
			'Exported to India',
		],
		'stock' => [
			'title' => 'Popular packs',
			'head'  => ['Wire diameter', 'Pack'],
			'rows'  => [['2.00 mm', '10 kg'], ['2.00 / 2.50 mm (SLS 31)', '25 kg']],
		],
		'applications' => ['Perimeter security', 'Agricultural fencing', 'Estates & plantations', 'Infrastructure projects'],
	],
	'pvc-coated-gi-wire' => [
		'name'     => 'PVC-Coated Galvanized Wire',
		'short'    => 'PVC-Coated GI Wire',
		'badge'    => 'European Technology',
		'family'   => 'Galvanized Wire',
		'image'    => 'products/pvc-gi-wire.webp',
		'gallery'  => ['products/pvc-coils.webp'],
		'lead'     => 'The strength of hot-dip galvanized steel, sealed in a tightly bonded PVC coating for long-term protection and a refined finish.',
		'overview' => [
			'Our PVC-coated galvanized wire combines the strength and structural integrity of hot-dip galvanized steel with the protection and finish of an advanced PVC coating. Manufactured using European technology, it achieves exceptional PVC adhesion — a uniform, tightly bonded coating that resists moisture, chemicals and environmental exposure.',
		],
		'specs' => [
			'Core'       => 'Hot-dip galvanized steel wire',
			'Coating'    => 'High-adhesion PVC',
			'Technology' => 'European',
			'Colour'     => 'Dark green',
		],
		'highlights' => [
			'Double protection: zinc layer plus PVC sheath',
			'Superior adhesion for a uniform, lasting finish',
			'Excellent mechanical performance',
		],
		'stock' => [
			'title' => 'Popular stock sizes',
			'head'  => ['Diameter', 'Coil weight'],
			'rows'  => [['2.60 mm · Dark green', '25 kg']],
		],
		'applications' => ['PVC chain link fencing', 'Barbed wire systems', 'Gabion structures', 'Building construction'],
	],
	'pvc-coated-barbed-wire' => [
		'name'     => 'PVC-Coated GI Barbed Wire',
		'short'    => 'PVC-Coated Barbed Wire',
		'badge'    => 'LAXAPANA',
		'family'   => 'Fencing',
		'image'    => 'products/pvc-barbed-wire.webp',
		'gallery'  => ['products/pvc-barbed-wire-20.webp'],
		'lead'     => 'Premium barbed wire with a refined PVC finish — built for modern urban settings and highly corrosive environments.',
		'overview' => [
			'Made entirely on a single integrated line — hot-dip galvanized wire, PVC coating and barbed wire fabrication — our PVC-coated barbed wire benefits from strict process control, consistency and traceability at every stage.',
			'Our advanced PVC processing delivers superior adhesion, significantly improving resistance to environmental degradation, abrasion and long-term wear. Standard coils are available, with customisation for specialised project requirements.',
		],
		'specs' => [
			'Coils'     => '10 kg & 20 kg',
			'Core'      => 'Hot-dip galvanized wire',
			'Coating'   => 'High-adhesion PVC',
			'Custom'    => 'Project-specific orders',
		],
		'highlights' => [
			'Single fully integrated production line',
			'Superior PVC adhesion against abrasion and wear',
			'Available island-wide through our distribution network',
		],
		'stock' => [
			'title' => 'Popular packs',
			'head'  => ['Wire diameter', 'Pack'],
			'rows'  => [['2.60 mm', '10 kg'], ['2.60 mm · Dark green', '20 kg']],
		],
		'applications' => ['Urban perimeter security', 'Coastal & corrosive sites', 'Commercial properties', 'Residential boundaries'],
	],
	'pvc-chain-link-fence' => [
		'name'     => 'PVC-Coated Chain Link Fence',
		'short'    => 'PVC Chain Link Fence',
		'badge'    => 'New · 2026',
		'family'   => 'Chain Link',
		'image'    => 'products/pvc-chain-link.webp',
		'gallery'  => ['products/chain-link-duo.webp'],
		'mascot'   => true,
		'lead'     => 'A value-added fencing solution made from our own premium GI and PVC-coated wire — strong, durable and good-looking.',
		'overview' => [
			'Introduced in 2026, our PVC-coated chain link fence is derived from our premium GI wire and PVC-coated wire, combining structural strength with enhanced durability and aesthetic appeal. It is manufactured to Sri Lankan Standards using European technology, with superior PVC adhesion for resistance to corrosion, exposure and mechanical wear.',
			'Marketed under the LAXAPANA brand and already supplied to major projects, it is available in standard sizes with the flexibility to meet customer-specific specifications.',
		],
		'specs' => [
			'Roll length' => '15 m',
			'Height'      => '1 m – 6 m',
			'Mesh sizes'  => '2″ × 2″ · 2¼″ × 2¼″ · 2½″ × 2½″',
			'Brand'       => 'LAXAPANA',
		],
		'highlights' => [
			'Made from our own GI and PVC-coated wire',
			'Manufactured to Sri Lankan Standards',
			'Custom heights and mesh sizes on request',
		],
		'stock' => [
			'title' => 'Popular stock rolls (15 m)',
			'head'  => ['Gauge', 'Mesh', 'Heights'],
			'rows'  => [['G12', '63 × 63 mm', '0.9 · 1.2 · 1.5 · 1.8 m'], ['G12', '50 × 50 mm', '1.2 · 1.5 · 1.8 m'], ['G10', '63 × 63 mm', '1.2 · 1.5 · 1.8 m'], ['G10', '50 × 50 mm', '1.2 · 1.5 · 1.8 m']],
		],
		'applications' => ['Agricultural fencing', 'Road development', 'Building construction', 'Prawn farming', 'Slope stabilisation'],
	],
	'gi-chain-link-fence' => [
		'name'     => 'Galvanized Wire Chain Link Fence',
		'short'    => 'GI Chain Link Fence',
		'badge'    => 'New · 2026',
		'family'   => 'Chain Link',
		'image'    => 'products/gi-chain-link.webp',
		'lead'     => 'A cost-effective, dependable chain link fence for infrastructure and construction — in commercial or heavy galvanizing.',
		'overview' => [
			'Introduced in 2026 to meet growing demand in the infrastructure and construction sectors, our galvanized chain link fence is made from high-quality hot-dip galvanized wire. Choose commercial coating or heavy galvanizing for the corrosion resistance and service life your project needs.',
		],
		'specs' => [
			'Roll length' => '15 m',
			'Height'      => '1 m – 6 m',
			'Mesh sizes'  => '2″ × 2″ · 2¼″ × 2¼″ · 2½″ × 2½″',
			'Coating'     => 'Commercial or heavy galvanized',
		],
		'highlights' => [
			'Cost-efficient choice for general applications',
			'Two coating classes to match the environment',
			'Custom specifications for project requirements',
		],
		'applications' => ['Construction sites', 'Infrastructure projects', 'Industrial boundaries', 'General fencing'],
	],
	'tata-wire-products' => [
		'name'     => 'Tata Steel Wire Products',
		'short'    => 'Tata Wire Products',
		'badge'    => 'Sole Authorised Distributor',
		'family'   => 'Distribution',
		'image'    => 'products/tata-strand.webp',
		'photo'    => true,
		'gallery'  => ['products/tata-hts.webp'],
		'lead'     => 'Specialised high-performance wire from Tata Steel — available in Sri Lanka exclusively through Lanka SSL.',
		'overview' => [
			'Lanka SSL is the sole authorised distributor of Tata Steel wire products in Sri Lanka. Sourced from one of the world’s most respected steel makers, the range is engineered to international quality standards for high tensile strength, uniformity and reliability.',
			'Through this exclusive partnership we ensure dependable supply, consistent quality and efficient delivery for infrastructure, construction and specialised industrial manufacturing.',
		],
		'specs' => [
			'Source'     => 'Tata Steel',
			'Status'     => 'Sole authorised distributor',
			'Quality'    => 'International standards',
			'Supply'     => 'Island-wide',
		],
		'range' => ['High tensile strength (HTS) wire', 'Strand wire', 'Upholstery spring wire', 'Heavy galvanized iron wire', 'Shutter wire', 'Bead wire'],
		'applications' => ['Major infrastructure', 'Construction', 'Engineering', 'Industrial manufacturing'],
	],
	'laxapana-batteries' => [
		'name'     => 'LAXAPANA Batteries',
		'short'    => 'LAXAPANA Batteries',
		'badge'    => 'Super Heavy Duty',
		'family'   => 'LAXAPANA Consumer Range',
		'image'    => 'products/laxapana-batteries.webp',
		'gallery'  => ['products/battery-d.webp', 'products/battery-9v.webp', 'products/battery-aa-2.webp'],
		'lead'     => 'Dependable everyday power for the home and workplace — carrying the trusted LAXAPANA name.',
		'overview' => [
			'LAXAPANA batteries bring the reliability Sri Lankan households already associate with the LAXAPANA brand to everyday power. The range covers the most-used sizes for torches, radios, remote controls, clocks, toys and household devices.',
			'Super Heavy Duty and Extra Heavy Duty grades deliver steady, long-lasting output, and the batteries are available island-wide through the same distribution network that supplies our wire products.',
		],
		'specs' => [
			'Sizes'        => 'AA · D · 9V',
			'Grade'        => 'Super & Extra Heavy Duty',
			'Brand'        => 'LAXAPANA',
			'Availability' => 'Island-wide',
		],
		'highlights' => [
			'Popular household sizes in one trusted brand',
			'Heavy-duty grades for steady, long-lasting power',
			'Available through our island-wide dealer network',
		],
		'stock' => [
			'title' => 'Range',
			'head'  => ['Size', 'Grade'],
			'note' => 'Available island-wide through our dealers',
			'rows'  => [['AA', 'Super Heavy Duty'], ['D', 'Super Heavy Duty'], ['9V', 'Extra Heavy Duty']],
		],
		'applications' => ['Torches', 'Radios', 'Remote controls', 'Clocks', 'Toys', 'Household devices'],
	],
	'laxapana-led-bulbs' => [
		'name'     => 'LAXAPANA LED Bulbs',
		'short'    => 'LAXAPANA LED Bulbs',
		'badge'    => '2-Year Warranty',
		'family'   => 'LAXAPANA Consumer Range',
		'image'    => 'products/laxapana-led.webp',
		'photo'    => true,
		'gallery'  => ['products/laxapana-led-range.webp'],
		'lead'     => 'Bright, energy-saving Day Light LED bulbs that last up to 25,000 hours — backed by a 2-year warranty.',
		'overview' => [
			'The LAXAPANA LED range delivers bright Day Light illumination while using far less energy than conventional bulbs. Rated to last up to 25,000 hours, each bulb is backed by a 2-year warranty for peace of mind.',
			'Available from 5 W to 15.5 W in both B22 pin and E27 screw caps, there is a LAXAPANA LED to fit virtually every light fitting in Sri Lankan homes, shops and offices.',
		],
		'specs' => [
			'Wattage'   => '5 W – 15.5 W',
			'Caps'      => 'B22 pin · E27 screw',
			'Light'     => 'Day Light',
			'Life'      => 'Up to 25,000 hours',
		],
		'highlights' => [
			'2-year warranty on every bulb',
			'Rated life of up to 25,000 hours',
			'Energy-saving LED technology',
			'Fits standard B22 and E27 holders',
		],
		'stock' => [
			'title' => 'Range',
			'head'  => ['Wattage', 'Cap types'],
			'note' => 'All with a 2-year warranty',
			'rows'  => [['5 W', 'B22 pin · E27 screw'], ['7 W', 'B22 pin · E27 screw'], ['9 W', 'B22 pin · E27 screw'], ['12 W', 'B22 pin · E27 screw'], ['15.5 W', 'B22 pin · E27 screw']],
		],
		'applications' => ['Homes', 'Shops', 'Offices', 'Hotels & restaurants', 'Outdoor covered areas'],
	],
	'marquis-water-pumps' => [
		'name'     => 'MARQUIS Water Pumps',
		'short'    => 'MARQUIS Water Pumps',
		'badge'    => 'Complete Range',
		'family'   => 'Distributed Brands',
		'image'    => 'products/marquiz-pump.webp',
		'gallery'  => ['products/marquiz-jet.webp', 'products/marquiz-booster.webp', 'products/marquiz-submersible.webp', 'products/marquiz-controller.webp'],
		'lead'     => 'A complete range of domestic, agricultural and light-industrial water pumps — from centrifugal and jet pumps to submersibles and controllers.',
		'overview' => [
			'MARQUIS pumps cover almost every water-moving need: centrifugal and jet pumps for water supply and irrigation, peripheral and automatic booster pumps for household pressure, submersible pumps for drainage and wastewater, and borehole pumps for deep wells.',
			'Electronic pressure controllers complete the range, switching pumps on and off automatically and protecting them against running dry. The range is available through the Lanka SSL distribution network.',
		],
		'specs' => [
			'Types'      => 'Surface · Submersible · Borehole',
			'Uses'       => 'Domestic · Agriculture · Drainage',
			'Accessory'  => 'Electronic pressure controller',
			'Supply'     => 'Through our dealer network',
		],
		'highlights' => [
			'One brand for surface, submersible and borehole pumping',
			'Automatic booster and controller options for steady pressure',
			'Models for clean water, drainage and wastewater',
		],
		'stock' => [
			'title' => 'Product range', 'note' => 'Contact us for model specifications and availability',
			'head'  => ['Type', 'Series', 'Typical use'],
			'rows'  => [
				['Centrifugal', 'MCP · 2MCP · MGA / MHF', 'Water supply, irrigation, transfer'],
				['Jet (self-priming)', 'MJM · MJSW', 'Wells and water supply'],
				['Peripheral', 'MKP', 'Household water supply'],
				['Automatic booster', 'MQS', 'Constant household pressure'],
				['Submersible', 'SA · 3SA · MSAm · SP · SUP · V', 'Drainage and wastewater'],
				['Borehole', '3SWM · 4SWM', 'Deep wells'],
				['Pressure controller', 'EC-2', 'Automatic on/off control'],
			],
		],
		'applications' => ['Homes', 'Agriculture & irrigation', 'Water supply', 'Drainage', 'Deep wells', 'Building services'],
	],
	'toa-spray' => [
		'name'     => 'TOA Spray Paint',
		'short'    => 'TOA Spray',
		'badge'    => '61 Colours',
		'family'   => 'Distributed Brands',
		'image'    => 'products/toa-spray.webp',
		'gallery'  => ['products/toa-chrome.webp', 'products/toa-fluorescent.webp', 'products/toa-heat.webp'],
		'lead'     => 'Quick-drying aerosol spray paint in 61 colours and finishes — from everyday colours to metallic, fluorescent and heat-resistant.',
		'overview' => [
			'TOA Spray is a convenient, quick-drying aerosol paint for fast, even coverage on metal, wood and many other surfaces. It is ideal for touch-ups, DIY projects, furniture, vehicles, machinery and signage.',
			'The range includes 61 shades: standard colours, metallic and chrome effects, fluorescent colours, heat-resistant finishes, primers and clear lacquers — including popular machinery and vehicle colour matches.',
		],
		'specs' => [
			'Colours'   => '61 shades',
			'Finishes'  => 'Gloss · Flat · Metallic · Fluorescent',
			'Specialty' => 'Heat-resistant · Primers · Clear',
			'Format'    => 'Aerosol spray can',
		],
		'highlights' => [
			'Quick-drying, even coverage',
			'Wide colour choice including metallic and fluorescent',
			'Primers and clear lacquers for a professional finish',
		],
		'stock' => [
			'title' => 'Colour range', 'note' => '61 colours — contact us for availability',
			'head'  => ['Category', 'Examples'],
			'rows'  => [
				['Standard colours', 'White, Black, Red, Yellow, Blues, Greens, Grey, Brown, Maroon…'],
				['Machinery & vehicle colours', 'Toyota Yellow, Kubota, Bosch Blue, Makita Turquoise, Ferrari Red, Taxi colours'],
				['Metallic', 'Gold, Silver, Chrome, Copper, Brass, Pearl Gold, Metallic Gold'],
				['Fluorescent', 'Red, Yellow, Orange, Green, Pink'],
				['Heat-resistant', 'Flat Black, Silver, Black'],
				['Primers & clear', 'Anti-rust primer, Primer surfacer, Plastic primer, Clear lacquer, Flat clear'],
			],
		],
		'applications' => ['Metal work', 'Furniture', 'Vehicles', 'Machinery', 'Signage', 'DIY & touch-ups'],
	],
];

$SPEC_TABLES = [
	'commercial' => [
		'title' => 'Commercial Galvanized Wire',
		'head'  => ['Diameter (mm)', 'Tolerance (mm)', 'UTS (kg/mm²)', 'Zn coating (gsm) min', 'Coil weight (kg)', 'Coil ID min (mm)', 'Coil ID max (mm)'],
		'rows'  => [
			['1.4 – 2.0', '± 0.07', '40 – 65', '40', '25 – 500', '400', '860'],
			['2.0 – 2.5', '± 0.07', '40 – 65', '45', '25 – 500', '400', '860'],
			['2.5 – 3.0', '± 0.08', '40 – 65', '50', '25 – 500', '400', '860'],
			['3.0 – 5.0', '± 0.10', '40 – 65', '70', '25 – 500', '400', '860'],
		],
	],
	'heavy' => [
		'title' => 'Heavy Coated Galvanized Wire',
		'head'  => ['Diameter (mm)', 'Tolerance (mm)', 'UTS (kg/mm²)', 'Zn coating (gsm) min', 'Coil weight (kg)', 'Coil ID min (mm)', 'Coil ID max (mm)'],
		'rows'  => [
			['1.4 – 2.0', '± 0.10', '40 – 65', '215', '25 – 500', '400', '860'],
			['2.0 – 2.5', '± 0.10', '40 – 65', '230', '25 – 500', '400', '860'],
			['2.5 – 3.0', '± 0.11', '40 – 65', '255', '25 – 500', '400', '860'],
			['3.0 – 5.0', '± 0.13', '40 – 65', '280', '25 – 500', '400', '860'],
		],
	],
	'nail' => [
		'title' => 'Nail Wire',
		'head'  => ['Diameter (mm)', 'Tolerance (mm)', 'UTS (kg/mm²)', 'Coil weight (kg)', 'Coil ID min (mm)', 'Coil ID max (mm)'],
		'rows'  => [
			['1.4 – 2.0', '± 0.05', '70 – 110', '25 – 500', '400', '860'],
			['2.0 – 2.5', '± 0.05', '50 – 80', '25 – 500', '400', '860'],
			['2.5 – 3.0', '± 0.05', '50 – 80', '25 – 500', '400', '860'],
			['3.0 – 5.0', '± 0.05', '50 – 80', '25 – 500', '400', '860'],
		],
	],
];

$APPLICATIONS = [
	['Chain link fencing', 'apps/chain-link-fence.webp'],
	['Gabion boxes', 'apps/gabion.webp'],
	['Welded mesh', 'apps/welded-mesh.webp'],
	['Poultry mesh', 'apps/poultry-mesh.webp'],
	['Wire nails', 'apps/nails.webp'],
	['Cable armouring', 'apps/cable-armouring.webp'],
];

/* ------------------------------------------------------------------ */
/* Company                                                            */
/* ------------------------------------------------------------------ */

$MILESTONES = [
	['Before 1998', 'An import-only market', 'Sri Lanka’s steel wire needs were met entirely through imports.'],
	['1998', 'Local manufacturing begins', 'Industrialist Mr. Mahenthiran Subramanium pioneers steel wire production in Sri Lanka.'],
	['2003', 'Tata Steel acquisition', 'Tata Steel acquires Mascon Wire Industries’ hot-dip galvanizing business — its first overseas acquisition. Lanka SSL is incorporated under the BOI in November.'],
	['2015', 'Part of E.B. Creasy', 'In March, E.B. Creasy & Co. PLC acquires the company, strengthening its local identity while retaining global standards.'],
	['2026', 'Chain link fencing', 'PVC-coated and galvanized chain link fences join the LAXAPANA range.'],
];

$VALUES = [
	['Integrity', 'Conducting business fairly, transparently and ethically — every action able to withstand the highest scrutiny.'],
	['Unity', 'Collaboration and teamwork through mutually beneficial relationships with employees, customers and partners.'],
	['Responsibility', 'Accountability toward the environment, our communities and the nation, with sustainable practices.'],
	['Excellence', 'The highest standards of performance, quality and service in every aspect of the business.'],
	['Understanding', 'Empathy, respect and compassion in all relationships, contributing positively to society.'],
];

$STRENGTHS = [
	['Consistent quality', 'High quality standards maintained throughout the manufacturing process.'],
	['Responsible sourcing', 'Raw materials from reputed and reliable global suppliers.'],
	['Competitive pricing', 'Supported by reliable stock availability.'],
	['Short lead times', 'Efficient production and logistics from order to delivery.'],
	['Flexible orders', 'Specific customer requirements met — even for small batches.'],
	['Century-old backing', 'Part of a diversified conglomerate with over 100 years of heritage.'],
	['Continuous improvement', 'Driven by innovation and employee engagement.'],
];

$PILLARS = [
	['Our People', 'A culture of teamwork, nurtured talent and strong leadership — empowered with pride, passion and shared purpose.'],
	['Our Offer', 'The supplier of choice, delivering reliable high-quality products with value-added services.'],
	['Our Innovation', 'Continuous advancement in technology, processes and products to stay responsive to the market.'],
	['Our Conduct', 'A safe workplace, minimal environmental impact, community support and the highest ethical standards.'],
];

$BOARD = [
	['name' => 'Mr. S.D.R. Arudpragasam', 'cred' => 'FCMA (UK)', 'role' => 'Chairman',
	 'bio' => 'Appointed to the Board on 31st March 2015 and Chairman from 1st April 2015. He serves as Chairman of several subsidiaries of The Colombo Fort Land & Building PLC and is Deputy Chairman of The Colombo Fort Land & Building PLC and Lankem Ceylon PLC. He is also Managing Director of E.B. Creasy & Company PLC, and a Fellow of the Chartered Institute of Management Accountants (UK).'],
	['name' => 'Mr. S. Rajaratnam', 'cred' => 'B.Sc., CA', 'role' => 'Director',
	 'bio' => 'Appointed to the Board on 31st March 2015. He is Deputy Managing Director of E.B. Creasy & Company PLC, with other directorships in The Colombo Fort Land & Building Group. He holds a B.Sc. in Business Administration from Boston College, USA, and is a member of the Institute of Chartered Accountants in Australia.'],
	['name' => 'Mr. R.C.A. Welikala', 'cred' => '', 'role' => 'Director',
	 'bio' => 'Brings extensive experience in marketing fast-moving consumer goods and has developed key brands in the E.B. Creasy Group into market leaders. He holds other directorships within The Colombo Fort Land & Building Group.'],
	['name' => 'Mr. P.M.A. Sirimane', 'cred' => 'FCA, MBA', 'role' => 'Director',
	 'bio' => 'Appointed to the Board on 31st March 2015. He serves on the Board of E.B. Creasy & Company PLC and several of its subsidiaries. He was previously Managing Director/CEO of Mercantile Leasing Ltd., Group Finance Director of United Tractor & Equipment Ltd. and CFO of Sri Lanka Telecom. He is a Fellow of the Institute of Chartered Accountants of Sri Lanka and holds an MBA from Swinburne University, Australia.'],
	['name' => 'Mr. S.W. Gunawardena', 'cred' => 'B.Sc., MBA', 'role' => 'Director',
	 'bio' => 'Appointed to the Board on 31st March 2015. He serves on the Board of E.B. Creasy & Company PLC and several subsidiaries. A B.Sc. graduate of the University of Colombo, he holds an MBA from the Postgraduate Institute of Management, University of Sri Jayewardenepura.'],
	['name' => 'Mr. R.N. Bopearatchy', 'cred' => 'B.Sc. (Cey), Dip. BM, MBA (Col)', 'role' => 'Director',
	 'bio' => 'Appointed to the Board on 18th January 2016. He has considerable expertise in product development, manufacturing and marketing of pesticides, pharmaceuticals and consumer products, and has chaired the Pesticide Association of Sri Lanka and the Toxicological Society of Sri Lanka. He holds several directorships within The Colombo Fort Land & Building Group.'],
	// TODO: confirm Dasun's full name, credentials and profile.
	['name' => 'Mr. Dasun', 'cred' => '', 'role' => 'Director', 'bio' => ''],
];

$CEO = ['name' => 'Mr. Janaka Perera', 'role' => 'Chief Executive Officer', 'photo' => 'people/ceo.webp'];

$MANAGEMENT = [
	['Mr. W. P. Chinthaka Gayan', 'Head of Sales & Marketing', 'chinthaka-gayan'],
	['Mr. H. Rashika Seram', 'Senior Manager – Quality Assurance & QMS', 'rashika-seram'],
	['Mr. Thusitha Nissanga', 'Senior Manager – Sales & Marketing', 'thusitha-nissanga'],
	['Ms. P. Roshani Tissera', 'Chief Financial Officer', 'm12'],
	['Mr. G. H. P. Chamith Janaka', 'Senior Manager – HR Business Partner', 'm1'],
	['Mr. P. K. Ishan Buddhika Priyalal', 'Manager – IT & Material', 'm2'],
	['Ms. K. M. Ganga Perera', 'Manager – Sales Administration', 'm11'],
];

/* ------------------------------------------------------------------ */
/* Achievements                                                       */
/* ------------------------------------------------------------------ */

$AWARDS = [
	['2023', 'National Convention on Quality & Productivity', '4 Gold · 1 Bronze'],
	['2022', 'National Convention on Quality & Productivity', '1 Gold · 2 Silver'],
	['2021', 'National Business Excellence Awards', 'First Runner-up · Overall Large Category'],
	['2021', 'National Convention on Quality & Productivity', '4 Gold'],
	['2020', 'CNCI Achiever Awards', 'National Gold · Extra-Large Manufacturing · Top Ten'],
	['2020', 'National Convention on Quality & Productivity', '1 Gold'],
	['2019', 'National Convention on Quality & Productivity', '2 Gold'],
	['2018', 'National Business Excellence Awards', 'Winner · Manufacturing – Other'],
	['2018', 'National Business Excellence Awards', 'Second Runner-up · Large Category'],
	['2015', 'National Business Excellence Summit', 'Gold · Quality Circle Competition'],
	['2015', 'National Convention on Quality & Productivity', 'Gold'],
	['2014', 'International Convention on Quality Control Circles', '1 Gold · 1 Silver'],
];

$CERTIFICATES = [
	['ISO 9001:2015', 'Quality Management System', 'Marketing and supply of galvanized mild steel wire, barbed wire and their PVC-coated variants.', 'certs/cert1.webp', 'marks/iso9001.png'],
	['SLS 139:2003', 'Sri Lanka Standards Institution', 'Galvanized mild steel wire for general engineering purposes.', 'certs/cert2.webp', 'marks/sls.png'],
	['ISO 45001:2018', 'Occupational Health & Safety', 'Manufacture, marketing and supply of galvanized mild steel wire and barbed wire.', 'certs/cert3.webp', 'marks/iso45001.png'],
	['IS 280:2006', 'Bureau of Indian Standards (BIS)', 'Galvanized wire for export to India — one of few foreign manufacturers so certified.', 'certs/cert4.webp', 'marks/is280.png'],
];

/*
 * Press releases, newest / most important first.
 * TODO: add the Indian press releases at the top of this list once the files are supplied.
 */
$PRESS = [
	['Lanka SSL wire products guarantee long service life, local research proves', 'Research', 'press/article-1.webp', 'assets/img/product/pdf/press-release-article2.pdf', 'English'],
	['Local research proves the service life of Lanka SSL wire products', 'Research', 'press/article-2.webp', 'assets/img/product/pdf/press-release-article1.pdf', 'Sinhala'],
	['Local research proves the service life of Lanka SSL wire products', 'Research', 'press/article-3.webp', 'assets/img/product/pdf/press-release-article3.pdf', 'Tamil'],
	['Lanka SSL’s winning streak towards excellence continues', 'Awards', 'press/press4.webp', null, 'English'],
	['Lanka SSL’s winning streak towards excellence continues', 'Awards', 'press/press8.webp', null, 'Photo'],
	['Lanka SSL’s winning streak towards excellence continues', 'Awards', 'press/press9.webp', null, 'Photo'],
	['Lanka SSL wins National Gold and Top Ten awards — 2020', 'Awards', 'press/press1.webp', null, 'English'],
	['Lanka SSL wins National Gold and Top Ten awards — 2020', 'Awards', 'press/press2.webp', null, 'Sinhala'],
];

$BROCHURES = [
	['Hot-Dipped vs Electro Galvanized Wire', 'Sinhala', 'brochures/brochure-1.webp', 'assets/img/product/pdf/brochure1.pdf'],
	['Hot-Dipped vs Electro Galvanized Wire', 'Tamil', 'brochures/brochure-2.webp', 'assets/img/product/pdf/brochure2.pdf'],
	['Company & Product Brochure', 'English', 'brochures/brochure-3.webp', 'assets/img/product/pdf/brochure3.pdf'],
	['GI Wire & Nail Wire Specifications', 'English', 'brochures/brochure-4.webp', 'assets/img/product/pdf/brochure4.pdf'],
];

/* Gallery — religious images intentionally excluded. */
$GALLERY = [
	'facility'   => ['label' => 'Our Facility', 'items' => ['g1', 'g2', 'g20', 'g9']],
	'operations' => ['label' => 'Operations', 'items' => ['g16', 'g17', 'g19', 'g18', 'g11', 'g22', 'g23']],
	'people'     => ['label' => 'Our People', 'items' => ['g3', 'g8', 'g12', 'g14', 'g15', 'g13', 'g4', 'g5', 'g10', '2024-jan6', '2024-jan2']],
	'awards'     => ['label' => 'Awards', 'items' => ['g7', 'g21', 'g25', 'g26', 'g27', 'g6']],
	'events'     => ['label' => 'Events', 'items' => ['g31', 'g32', 'g33', 'g34', 'g35', 'g36', 'g39', '2024-jan4', '2024-jan5', '2024-jan7', '2024-jan8', '2024-jan9', '2024-jan10', '2024-jan11']],
	'csr'        => ['label' => 'Safety & CSR', 'items' => ['g24', 'safety-3', 'g28', 'g29', 'g30']],
];

$VACANCIES = [
	['Sales Manager', 'Sales & Marketing', 'Drive revenue growth through strategic sales plans, strong client relationships and new business opportunities — negotiating and closing deals while exceeding targets.'],
	['IT Manager', 'Information Technology', 'Lead the planning, implementation and maintenance of our IT systems, ensuring optimal functionality and security while driving continuous improvement.'],
	['Senior Production Manager', 'Operations', 'Lead production end-to-end — planning, scheduling, quality and resources — to optimise efficiency, minimise downtime and uphold strict quality standards.'],
];
