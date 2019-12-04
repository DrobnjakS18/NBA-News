<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'picture' => 'images/1552826296lebron-reacts-sideline-suns-0315.jpg',
                'small_picture' => 'images/small_images/small_1552826296lebron-reacts-sideline-suns-0315.jpg',
                'alt' => 'lebron-reacts-sideline-suns',
                'headline' => 'Kia MVP Ladder: Aberrant finish in award chase',
                'text' => 'All good things must come to an end, even for a four-time Kia MVP like LeBron James.
The sobering reality in his 16th season is that it has provided lesson after painful lesson for the man who dominated the NBA narrative for most of the past decade.
The Los Angeles Lakers’ playoffs hopes, as fleeting as they’ve been for weeks now, are all but over. The same is likely true for James’ personal streak of 13 straight playoff appearances.
His eight straight seasons playing in The Finals? Finished.
That stranglehold LeBron has had on a first team All-NBA spot? That likely comes to an end this season as well.
It also means his impressive run of top-five finishes in the MVP chase is likely to meet an ugly demise this season, too. He finished ninth in MVP voting his rookie season (2002-03) and sixth the following season before making the top five in every season since then … (likely) until now.
It’s not that he hasn’t posted MVP-caliber numbers -- his 27.4 points, 8.6 rebounds and eight assists per game are better than his career stats (27.2 ppg, 7.4 rpg, 7.2 apg). Individual metrics aren’t the problem, but rather the Lakers’ futility this season --  fueled in large part by his career-high 18-games missed due to injury and/or maintenance -- is what will cost him his customary spot on most MVP ballots.',
                'cat_id' => 1

            ],

            [
                'picture' => 'images/1552826393brogdon-dunk.jpg',
                'small_picture' => 'images/small_images/small_1552826393brogdon-dunk.jpg',
                'alt' => 'brogdon-dunk',
                'headline' => 'Brogdon out indefinitely with plantar fascia tear',
                'text' => 'MILWAUKEE – Milwaukee Bucks guard Malcolm Brogdon underwent an MRI and subsequent examination today by team physician Dr. William Raasch at Froedtert & the Medical College of Wisconsin. The exam revealed a minor plantar fascia tear in Brogdon’s right foot.
Brogdon will be listed as out and his status will be updated as appropriate.
In 64 games (all starts) for the Bucks this season, Brogdon is averaging a career-high 15.6 points, 4.5 rebounds and 3.2 assists in 28.6 minutes per game, while shooting career bests in field goal percentage (.505) and 3-point percentage (.426).
He is also shooting an NBA-high 92.8 percent from the free throw line, making him the only player in the NBA shooting better than 50.0 percent from the field, 40.0 percent from three-point distance and 90.0 percent from the foul line. A 50/40/90 season has only been done 13 times in NBA history.',
                'cat_id' => 1
            ],

            [
                'picture' => 'images/1552826529USATSI_11375423.jpg',
                'small_picture' => 'images/small_images/small_1552826529USATSI_11375423.jpg',
                'alt' => 'USATSI',
                'headline' => 'Lakers Ingram has successful surgery on arm',
                'text' => 'LOS ANGELES (AP)  -- Lakers forward Brandon Ingram is expected to be ready for next season after undergoing surgery on his right arm.
Ingram had thoracic outlet decompression surgery Saturday, the Lakers say.
Ingram was declared out for the season earlier this month after he was diagnosed with deep venous thrombosis. A blood clot caused shoulder pain for Ingram, who averaged a career-best 18.3 points and 5.1 rebounds this season.
Ingram s surgery was performed at the Ronald Reagan UCLA Medical Center.
The Lakers say he is expected to make a full recovery before the start of his fourth NBA season in the fall.
Ingram was the No. 2 pick in the 2016 draft out of Duke. He turns 22 in September.',
                'cat_id' => 1
            ],
            [
                'picture' => 'images/1552826637dion-waiters-iso.jpg',
                'small_picture' => 'images/small_images/small_1552826637dion-waiters-iso.jpg',
                'alt' => 'dion-waiters-iso',
                'headline' => 'Heat fine Waiters for postgame expletive-laden comments',
                'text' => 'BIRMINGHAM, Michigan (AP)  -- The Miami Heat have fined Dion Waiters an undisclosed amount for his expletive-laden comments about playing time earlier this week.
Waiters made the comments to reporters from two South Florida newspapers after Miami\'s lopsided loss in Milwaukee on Tuesday night. The Heat were off Wednesday and announced the fine Thursday.
"We fined him and we addressed it as a team," Heat coach Erik Spoelstra said.
Waiters has played in five games this season, all as a reserve. He missed just over a full year while recovering from surgery to repair a long-problematic ankle, and has repeatedly said that being patient throughout the process is a challenge for him.
"Look, this is going to be very difficult for Dion," Spoelstra said. "I have empathy for everything he\'s gone through in the last year to get back to where he is right now. But this is not about him. This is only about the team and it\'s about winning."
Miami is 21-21 this season, going into its game Friday at Detroit.',
                'cat_id' => 2
            ],

            [
                'picture' => 'images/1552826799rubio.jpg',
                'small_picture' => 'images/small_images/small_1552826799rubio.jpg',
                'alt' => 'rubio',
                'headline' => 'Jazz Ricky Rubio has hamstring strains',
                'text' => 'SALT LAKE CITY  -- The following is a medical update on Utah Jazz guard Ricky Rubio, forward Thabo Sefolosha and center Tony Bradley:
Rubio (6-4, 190, Spain) was examined Tuesday by the Utah Jazz medical staff and underwent magnetic resonance imaging (MRI) testing and the MRI revealed a mild right hamstring strain. He will be re-evaluated in one week.
Sefolosha (6-7, 220, Switzerland) was also examined Tuesday by the Jazz medical staff and underwent magnetic resonance imaging (MRI) testing and the MRI revealed a mild right hamstring strain. He will be re-evaluated in one week.
Bradley (6-11, 248, North Carolina) underwent a successful partial meniscectomy and debridement of his right knee on Tuesday. Bradley suffered the injury in the Stars’ 110-105 win against the Sioux Falls Skyforce on Jan. 4. He will be re-evaluated in one month.
Rubio is in his eighth NBA season, where he’s played in 40 games, holding averages of 12.8 points, 6.2 assists, 3.6 rebounds and 1.3 steals in 29.2 minutes per game.
Sefolosha is currently in his 13th year, second with Utah, and is averaging 3.0 points and 2.8 boards in 11.1 minutes in 2018-19.',
                'cat_id' => 2
            ],

            [
                'picture' => 'images/1552826856GettyImages-1124805868.jpg',
                'small_picture' => 'images/small_images/small_1552826856GettyImages-1124805868.jpg',
                'alt' => 'GettyImages',
                'headline' => 'Reports: Nuggets pull Isaiah Thomas from rotation',
                'text' => 'After a delayed start to his inaugural campaign with the Nuggets, guard Isaiah Thomas might be set for an early finish. Reports out of Denver confirm that coach Michael Malone intends to shorten his rotation for the stretch run, and Thomas didn\'t play in Tuesday\'s 133-107 victory against the Timberwolves.
“Definitely talked to him,” Malone told reporters after the game. “I’ll keep that conversation between I.T. and myself,” Malone said. “Not an easy conversation, but that’s my job. ... Isaiah is a pro and was into the game, supporting his teammates.”
Per Sean Keeler of the Denver Post, Malone -- who previously coached Thomas when both were in Sacramento -- indicated it had more to do with a holistic approach than any sleight on individual performance.
“It’s never about Isaiah. It’s never about any individual,” Malone explained. “It’s about what I think is best for our team. And I made the decision to shorten the rotation, only played eight guys in the first quarter. And I’m going to continue to do that for the time being.”',
                'cat_id' => 1
            ],

            [
                'picture' => 'images/1552827211stephen-curry-pregame.jpg',
                'small_picture' => 'images/small_images/small_1552827211stephen-curry-pregame.jpg',
                'alt' => 'stephen-curry-pregame',
                'headline' => 'Curry, Kerr speak on Warriors’ issues as Green sits again',
                'text' => 'Golden State’s Stephen Curry knows that the rift between teammates Kevin Durant and Draymond Green might be viewed by outsiders as something that can doom the Warriors this season.
To them, he has a message.
“That’s not going to happen,” Curry said.
Curry spoke publicly Saturday night for the first time about the testy exchange between Durant and Green -- they went at each other late in what became an overtime loss to the LA Clippers last Monday night, and the fallout has been a major talking point around the NBA since -- and lauded both players for the way they’re handing the situation.
“I think the way we’ve handled it as a team, the way Draymond’s handled it, the way KD’s handled it, it’s been nothing but professionalism,” Curry said.
Green is getting the weekend off. The Warriors held him out of their game in Dallas on Saturday because of an ongoing issue with a toe on his right foot, a game Golden State lost 112-109. He also did not play as Golden State lost 104-92 on the road to the San Antonio Spurs on Sunday.
To coach Steve Kerr, the difficult times the Warriors have faced of late show just how fortunate the team has been overall the last few seasons. In racking up back-to-back NBA titles and three championships in the last four seasons, Golden State has made life in the NBA look simple at times.',
                'cat_id' => 1
            ]

        ]);
    }
}
