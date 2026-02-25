<?php 
include "header.php";

date_default_timezone_set("Asia/Manila");

$flightSchedules = [
    // ----- DOMESTIC FLIGHTS -----
    [
        "flightNo" => "PR 2831",
        "airline" => "Philippine Airlines",
        "origin" => "Manila (MNL)",
        "destination" => "Cebu (CEB)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "dep" => "2026-03-01 08:00:00",
        "duration" => 90,
        "type" => "Domestic",
        "aircraft" => "Airbus A321",
        "gate" => "12A",
        "remarks" => "Morning flight - usually full"
    ],
    [
        "flightNo" => "5J 412",
        "airline" => "Cebu Pacific",
        "origin" => "Manila (MNL)",
        "destination" => "Davao (DVO)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "dep" => "2026-03-01 09:30:00",
        "duration" => 120,
        "type" => "Domestic",
        "aircraft" => "Airbus A320",
        "gate" => "8C",
        "remarks" => ""
    ],
    [
        "flightNo" => "Z2 215",
        "airline" => "AirAsia PH",
        "origin" => "Clark (CRK)",
        "destination" => "Caticlan (MPH)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "dep" => "2026-03-01 10:15:00",
        "duration" => 70,
        "type" => "Domestic",
        "aircraft" => "Airbus A320",
        "gate" => "4B",
        "remarks" => "Direct to Boracay"
    ],
    [
        "flightNo" => "PR 2654",
        "airline" => "Philippine Airlines",
        "origin" => "Manila (MNL)",
        "destination" => "Iloilo (ILO)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "dep" => "2026-03-01 11:00:00",
        "duration" => 75,
        "type" => "Domestic",
        "aircraft" => "De Havilland DHC-8",
        "gate" => "21D",
        "remarks" => "Turbo prop"
    ],
    [
        "flightNo" => "5J 328",
        "airline" => "Cebu Pacific",
        "origin" => "Cebu (CEB)",
        "destination" => "Puerto Princesa (PPS)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Manila",
        "dep" => "2026-03-01 13:00:00",
        "duration" => 80,
        "type" => "Domestic",
        "aircraft" => "Airbus A320",
        "gate" => "6A",
        "remarks" => "Palermo bound"
    ],
    
    // ----- INTERNATIONAL FLIGHTS  -----
    [
        "flightNo" => "PR 432",
        "airline" => "Philippine Airlines",
        "origin" => "Manila (MNL)",
        "destination" => "Tokyo (NRT)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Tokyo",
        "dep" => "2026-03-02 06:00:00",
        "duration" => 240,
        "type" => "International",
        "aircraft" => "Boeing 777-300ER",
        "gate" => "32E",
        "remarks" => "Breakfast served"
    ],
    [
        "flightNo" => "5J 803",
        "airline" => "Cebu Pacific",
        "origin" => "Manila (MNL)",
        "destination" => "Singapore (SIN)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Singapore",
        "dep" => "2026-03-02 07:00:00",
        "duration" => 210,
        "type" => "International",
        "aircraft" => "Airbus A330-900",
        "gate" => "15F",
        "remarks" => "Morning snack"
    ],
    [
        "flightNo" => "PR 510",
        "airline" => "Philippine Airlines",
        "origin" => "Manila (MNL)",
        "destination" => "Bangkok (BKK)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Bangkok",
        "dep" => "2026-03-02 08:30:00",
        "duration" => 180,
        "type" => "International",
        "aircraft" => "Airbus A321",
        "gate" => "28D",
        "remarks" => "Brunch"
    ],
    [
        "flightNo" => "Z2 102",
        "airline" => "AirAsia PH",
        "origin" => "Manila (MNL)",
        "destination" => "Seoul (ICN)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Asia/Seoul",
        "dep" => "2026-03-02 09:45:00",
        "duration" => 260,
        "type" => "International",
        "aircraft" => "Airbus A330-300",
        "gate" => "11C",
        "remarks" => "Lunch"
    ],
    [
        "flightNo" => "PR 300",
        "airline" => "Philippine Airlines",
        "origin" => "Manila (MNL)",
        "destination" => "Sydney (SYD)",
        "originTZ" => "Asia/Manila",
        "destTZ" => "Australia/Sydney",
        "dep" => "2026-03-02 22:00:00",
        "duration" => 480,
        "type" => "International",
        "aircraft" => "Boeing 777-300ER",
        "gate" => "45G",
        "remarks" => "Dinner + breakfast"
    ]
];

// Simple function to format duration
function formatDuration($mins) {
    $h = floor($mins / 60);
    $m = $mins % 60;
    if ($h > 0 && $m > 0) {
        return $h . 'h ' . $m . 'm';
    } elseif ($h > 0) {
        return $h . 'h';
    } else {
        return $m . 'm';
    }
}

// Track page load
$pageLoadTime = microtime(true);
?>

<link rel="stylesheet" href="assets/css/flight-board.css">

<div class="flight-dashboard">
    
    <div class="welcome-header">
        <h1>Manila Flight Schedules</h1>
        <p class="last-updated">Last updated: <?php echo date('F j, Y g:i A'); ?> PHT</p>
    </div>

    <div class="filter-section">
        <button class="filter-btn active" data-filter="all">All flights (<?php echo count($flightSchedules); ?>)</button>
        <?php 
        $domesticCount = 0;
        $intlCount = 0;
        foreach ($flightSchedules as $f) {
            if ($f['type'] === 'Domestic') $domesticCount++;
            else $intlCount++;
        }
        ?>
        <button class="filter-btn" data-filter="domestic">Domestic (<?php echo $domesticCount; ?>)</button>
        <button class="filter-btn" data-filter="international">International (<?php echo $intlCount; ?>)</button>
    </div>

    <div class="flights-container" id="flightsContainer">
        <?php 
        $flightCount = 0;
        foreach($flightSchedules as $schedule): 
            $flightCount++;
            
            // Skip if missing required fields
            if (empty($schedule['dep']) || empty($schedule['originTZ'])) {
                continue;
            }
            
            try {
                $originTz = new DateTimeZone($schedule["originTZ"]);
                $destTz = new DateTimeZone($schedule["destTZ"]);
                
                $departure = new DateTime($schedule["dep"], $originTz);
                $arrival = clone $departure;
                $arrival->modify("+" . $schedule["duration"] . " minutes");
                $arrival->setTimezone($destTz);
                
                $currentTime = new DateTime("now", $originTz);
                $timeDiff = $currentTime->diff($departure);
                
                $departureDay = $departure->format('D');
                $arrivalDay = $arrival->format('D');
                $departureDate = $departure->format('M j');
                $arrivalDate = $arrival->format('M j');
                
                $isOvernight = $departureDate !== $arrivalDate;
                
                // Simple status logic
                if ($timeDiff->invert == 0) {
                    if ($timeDiff->days > 0) {
                        $statusText = 'Scheduled';
                        $statusClass = 'status-scheduled';
                    } elseif ($timeDiff->h < 2) {
                        $statusText = 'Final call';
                        $statusClass = 'status-final';
                    } else {
                        $statusText = 'Check-in';
                        $statusClass = 'status-checkin';
                    }
                } else {
                    $statusText = 'Departed';
                    $statusClass = 'status-departed';
                }
                
                // Check for red-eye flights (10pm - 5am)
                $depHour = (int)$departure->format('H');
                $isRedEye = ($depHour >= 22 || $depHour <= 4);
                
            } catch (Exception $e) {
                // Skip problematic flights silently
                continue;
            }
        ?>
        
        <div class="flight-card <?php echo strtolower($schedule['type']); ?>" data-type="<?php echo strtolower($schedule['type']); ?>">
            
            <div class="card-header">
                <span class="flight-number"><?php echo $schedule["flightNo"]; ?></span>
                <span class="flight-type <?php echo strtolower($schedule['type']); ?>">
                    <?php echo $schedule['type']; ?>
                </span>
            </div>
            
            <div class="airline-info">
                <?php echo $schedule["airline"]; ?> 
                <?php if(!empty($schedule["gate"])): ?>
                    · Gate <?php echo $schedule["gate"]; ?>
                <?php endif; ?>
                <?php if(!empty($schedule["aircraft"])): ?>
                    · <?php echo $schedule["aircraft"]; ?>
                <?php endif; ?>
            </div>
            
            <div class="route-display">
                <div class="origin">
                    <span class="city-code"><?php echo substr($schedule["origin"], -4, 3); ?></span>
                    <span class="city-name"><?php echo explode(" (", $schedule["origin"])[0]; ?></span>
                </div>
                
                <div class="route-line">
                    <span class="duration-badge">
                        <?php echo formatDuration($schedule["duration"]); ?>
                    </span>
                </div>
                
                <div class="destination">
                    <span class="city-code"><?php echo substr($schedule["destination"], -4, 3); ?></span>
                    <span class="city-name"><?php echo explode(" (", $schedule["destination"])[0]; ?></span>
                </div>
            </div>
            
            <div class="time-details">
                <div class="departure-time">
                    <span class="time-label">Depart</span>
                    <span class="time-value <?php echo $isRedEye ? 'redeye' : ''; ?>">
                        <?php echo $departure->format("g:i A"); ?>
                    </span>
                    <span class="time-extra">
                        <?php echo $departureDay . ' ' . $departureDate; ?>
                    </span>
                </div>
                
                <div class="arrival-time">
                    <span class="time-label">Arrive</span>
                    <span class="time-value">
                        <?php echo $arrival->format("g:i A"); ?>
                    </span>
                    <span class="time-extra">
                        <?php echo $arrivalDay . ' ' . $arrivalDate; ?>
                        <?php if ($isOvernight): ?>
                            <span class="next-day">+1</span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            
            <?php if ($schedule["originTZ"] !== $schedule["destTZ"]): ?>
            <div class="timezone-note">
                <span class="tz-icon">🌐</span>
                <?php 
                $tzMap = [
                    'Asia/Tokyo' => 'Japan Time (JST)',
                    'Asia/Singapore' => 'Singapore Time (SGT)',
                    'Asia/Seoul' => 'Korea Time (KST)',
                    'Australia/Sydney' => 'Sydney (AEDT)',
                    'Asia/Bangkok' => 'Bangkok Time (ICT)'
                ];
                $tzDisplay = $tzMap[$schedule["destTZ"]] ?? $schedule["destTZ"];
                echo "Local time at destination: $tzDisplay";
                ?>
            </div>
            <?php endif; ?>
            
            <?php if(!empty($schedule["remarks"])): ?>
            <div class="flight-remarks">
                <span class="remarks-icon">📌</span>
                <?php echo $schedule["remarks"]; ?>
            </div>
            <?php endif; ?>
            
            <div class="flight-status <?php echo $statusClass; ?>">
                <?php echo $statusText; ?>
                <?php if ($statusText === 'Final call'): ?>
                    <span class="boarding-icon">🏃</span>
                <?php endif; ?>
            </div>
            
        </div>
        <?php endforeach; ?>
        
        <?php if ($flightCount === 0): ?>
        <div class="no-flights">
            <p>No flights available at this time</p>
            <p class="small">Please check back later</p>
        </div>
        <?php endif; ?>
    </div>

    <div class="timezone-panel">
        <h3>Current time at destinations</h3>
        <div class="timezone-grid">
            <?php
            $monitoredZones = [
                "Asia/Manila" => "🇵🇭 Manila (PHT)",
                "Asia/Tokyo" => "🇯🇵 Tokyo (JST)", 
                "Asia/Singapore" => "🇸🇬 Singapore (SGT)",
                "Asia/Seoul" => "🇰🇷 Seoul (KST)",
                "Australia/Sydney" => "🇦🇺 Sydney (AEDT)",
                "Asia/Bangkok" => "🇹🇭 Bangkok (ICT)"
            ];
            
            foreach($monitoredZones as $zoneId => $zoneLabel):
                $zoneTime = new DateTime("now", new DateTimeZone($zoneId));
            ?>
            <div class="timezone-card">
                <div class="zone-name"><?php echo $zoneLabel; ?></div>
                <div class="zone-time"><?php echo $zoneTime->format("g:i A"); ?></div>
                <div class="zone-date"><?php echo $zoneTime->format("M j"); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="stats-panel">
        <h3>Flight summary</h3>
        <div class="stats-grid">
            <?php
            
            $totalFlights = count($flightSchedules);
            
            $domesticTotal = 0;
            $intlTotal = 0;
            $airlineList = [];
            $longestDuration = 0;
            $longestDestName = '';
            
            foreach ($flightSchedules as $f) {
                // Count by type
                if ($f['type'] === 'Domestic') {
                    $domesticTotal++;
                } else {
                    $intlTotal++;
                }
                
                // Collect unique airlines
                if (!in_array($f['airline'], $airlineList)) {
                    $airlineList[] = $f['airline'];
                }
                
                // Find longest flight
                if ($f['duration'] > $longestDuration) {
                    $longestDuration = $f['duration'];
                    $longestDestName = explode(" (", $f['destination'])[0];
                }
            }
            
            $uniqueAirlines = count($airlineList);
            ?>
            
            <div class="stat-item">
                <span class="stat-value"><?php echo $totalFlights; ?></span>
                <span class="stat-label">Total flights</span>
            </div>
            
            <div class="stat-item">
                <span class="stat-value"><?php echo $domesticTotal; ?></span>
                <span class="stat-label">Domestic</span>
            </div>
            
            <div class="stat-item">
                <span class="stat-value"><?php echo $intlTotal; ?></span>
                <span class="stat-label">International</span>
            </div>
            
            <div class="stat-item">
                <span class="stat-value"><?php echo $uniqueAirlines; ?></span>
                <span class="stat-label">Airlines</span>
            </div>
            
            <div class="stat-item long-flight">
                <span class="stat-value"><?php echo formatDuration($longestDuration); ?></span>
                <span class="stat-label">Longest (<?php echo $longestDestName; ?>)</span>
            </div>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>