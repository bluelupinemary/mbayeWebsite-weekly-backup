
let chaptersMap = new Map(
    [
        [ 1,{
            "scripts":[1,21],
            "objects":[],
            }
        ],
        [ 2,{
            "scripts":[22,35],
            "objects":[],
            }
        ],
        [ 3,{
            "scripts":[47,53],
            "objects":[],
            }
        ],
        [ 4,{
            "scripts":[54,55],
            "objects":[],
           }
        ],
    
    ]
);


let stageMap = new Map(
    [
        [ 1,{
            
            "imagesUsed":['collage-1-2.png','burj.png'],
            "texts":[ "Once upon a time,","a carpenter from Small Heath in Birmingham,","who more than 40 years after leaving those","industrial-declined streets,",
                        "found himself the owner of a Stainless Steel factory","amongst the high-rise metropolis of","Dubai."

                    ],
            }
        ],
        [ 3,{   
            
            "collage":'collage-3-1.png',
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:6.5vw'><span style='font-size:5vw;'>Y</span>ears after arriving</div>",
                    "<div class='overlayTxt' id='txt2' style='height:6.5vw'>and building his business,</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.5vw'>he was requested to build something</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.5vw'>which he would decide should last</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.7vw'>as long as the pyramids of Egypt or</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.7vw'>the Collosal Monuments in Rome</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.7vw'>and the Aztec Cities of the</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.7vw'>Americas.</div>"
                    ],  
            }
        ],
        [ 4,{   
            
            "discImg":"origMbaye.jpg",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.1vw;text-align:left;padding-left:7vw;'><span style='font-size:5vw;'>T</span>he Carpenter who became the creator of Mbaye</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.1vw;text-align:left;padding-left:5vw;'><span style='padding-right: 28vw;'>on being requested</span>to sculpt a</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.1vw;text-align:left;padding-left:5vw;'><span style='padding-right: 25vw;'>12 meters high head</span> of a lion, asked </div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.1vw;text-align:left;padding-left:5vw;'><span style='padding-right: 25vw;'>for the significance</span> of the lion.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.1vw;text-align:left;padding-left:5vw;'><span style='padding-right: 25vw;'>He requested for how</span> long it must stand,</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.1vw;text-align:left;padding-left:5vw;'><span style='padding-right: 25vw;'>from what materials</span> she would be built.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.1vw;text-align:left;padding-left:5vw;'><span style='padding-right: 25vw;'>What was the story to</span> be behind her.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:5.1vw;text-align:left;padding-left:5vw;'><span style='padding-right: 3vw;'>The reply he received was</span> his inspiration,for they</div>",
                    "<div class='overlayTxt' id='txt9' style='height:5.1vw;text-align:left;padding-left:5vw;'>were the words he had for too long hated hearing.</div>"
                    
                    ],  
            }
        ],
        [ 5,{   
            
            "imagesUsed":['lion1.png','lion2.png','lion3.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.1vw;text-align:left;padding-left:7vw;'><span style='font-size:5vw;'>H</span>ate was not of his nature </div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.1vw;text-align:left;padding-left:5vw;'>but such words were the antithesis of his mind.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.1vw;text-align:left;padding-top:20vw;padding-left:20vw;'>\"<span style='font-size:5vw;'>W</span>e don’t care, just design and build it.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.1vw;text-align:left;padding-left:45vw;'>If we like it,</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.1vw;text-align:left;padding-left:20vw;'>then you have a chance of the contract\".</div>"
                    ],  
            }
        ],
        [ 6,{   
            
            "imagesUsed":['manBed.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.1vw;text-align:center;padding-top:1vw;'>The words tormented him</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.1vw;text-align:center;padding-left:25vw;'>but inspired him,</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.1vw;text-align:center;padding-left:25vw;'>that night he awoke</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.1vw;text-align:center;padding-left:16vw;'>in the early hours of the morning,</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.1vw;text-align:center;padding-left:12vw;'>tormented by the words he had heard.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.1vw;text-align:left;padding-left:5vw;'>\"We don’t care\".</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.1vw;text-align:left;padding-left:5vw;'>He was fed up hearing these words in life.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:5.1vw;text-align:left;padding-left:30vw;'>You can never be successful</div>",
                    "<div class='overlayTxt' id='txt9' style='height:5.1vw;text-align:left;padding-left:40vw;'>if you don’t care!</div>",
                    ],  
            }
        ],
        [ 7,{   
            
            "imagesUsed":['manChair1.png','manChair2.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.1vw;text-align:center;padding-top:1vw;'>He couldn’t sleep again,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.1vw;text-align:center;padding-left:25vw;'>so he started designing</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.1vw;text-align:center;padding-left:18vw;'>through the torments of his mind.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.1vw;text-align:left;padding-left:5vw;padding-top:5vw;'>He took in mind,</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.1vw;text-align:left;padding-left:5vw;'>\"Why if I have the chance to build</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.1vw;text-align:left;padding-left:5vw;'>a statue of 12 meters high</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.1vw;text-align:left;padding-left:5vw;'>and 20 meters long, why can’t I build it</div>",
                    "<div class='overlayTxt' id='txt8' style='height:5.1vw;text-align:left;padding-left:35vw;'>to last forever?\"</div>",
                    ],  
            }
        ],
        [ 8,{   
            "collage":'collage-8-1.png',
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.1vw;text-align:center;padding-top:2vw;'>When he looked into the character of lions,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.1vw;text-align:center;'>he discovered that all they really do is care.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.1vw;text-align:center;'>The lioness cares more than the lion.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.1vw;text-align:center;padding-top:7vw;'>Care for their young, their food, each other.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.1vw;text-align:center;'>They only care.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.1vw;text-align:center;padding-top:3vw;'>This was his answer,</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.1vw;text-align:center;'>“this statue would be dedicated to care”.</div>"
                    ],  
            }
        ],
        [ 9,{   
            
            "discImg":"lionDisc.jpg",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.1vw;text-align:left;padding-top:1vw;padding-left:5vw;'>As the lioness cares more,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.1vw;text-align:left;padding-left:5vw;'>he changed the lion</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.1vw;text-align:left;padding-left:5vw;'>to a lioness and</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.1vw;text-align:left;padding-left:5vw;'>decided she would</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.1vw;text-align:left;padding-left:5vw;'>stand for what</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.1vw;text-align:left;padding-left:5vw;'>she cared for.<span style='padding-left:40vw;'>Not just the</span></div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.1vw;text-align:center;padding-left:30vw;'>head</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.1vw;text-align:center;padding-left:28vw;'>but a full standing</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.1vw;text-align:center;padding-left:30vw;'>lioness.</div>"
                    ],  
            }
        ],
        [ 10,{   
            "discImg":"lionDisc.jpg",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.3vw;text-align:left;padding-top:1vw;padding-left:5vw;'>Naming her was about caring,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.3vw;text-align:left;padding-left:5vw;'>to give the credit,the glory</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.3vw;text-align:left;padding-left:5vw;'>to somebody else of her</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.3vw;text-align:left;padding-left:18vw;'>existence,</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.3vw;text-align:left;padding-left:5vw;'>not himself because a</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.3vw;text-align:left;padding-left:13vw;'>pleasure of his</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.3vw;text-align:left;padding-left:5vw;'>was he enjoyed opening</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.3vw;text-align:left;padding-left:5vw;'>the door for someone else,</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.3vw;text-align:left;padding-left:5vw;'>it was more pleasure than</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.3vw;text-align:left;padding-left:10vw;'>opening it for himself.</div>"
                 ],  
            }
        ],
        [ 11,{ 
            "collage":'collage-11-1.png',  
            "discImg":"",
            "imagesUsed":['poshStore.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.3vw;text-align:center;padding-top:1vw;'>You see although he remembered all the cold nights he walked home</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.3vw;text-align:center;'>across the grimy streets of Birmingham,</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.3vw;text-align:center;'>dreaming someone would open a door and offer a hot drink.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.3vw;text-align:center;'>He also was influenced by once opening a door to a posh store.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.3vw;text-align:center;'>At that moment of opening he saw an elegant lady approaching</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.3vw;text-align:center;'>and said,</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.3vw;text-align:center;'>\"Please Ma’am after you\".</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.3vw;text-align:center;padding-top:3vw;'>As she thanked him he filled up with pride at the power of </div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.3vw;text-align:center;'>opening a door for someone else and this became a very important</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.3vw;text-align:center;'>lesson in life.</div>"
                 ],  
            }
        ],
        [ 12,{ 
            "collage":'',  
            "discImg":"mbayeDiagne.jpg",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.1vw;text-align:center;padding-top:1vw;'>He found the story of  Mbaye Diagne</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.1vw;text-align:left;padding-left:5vw;padding-top:2vw;font-size:3.5vw;'>and Mbaye was born.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.1vw;text-align:center;padding-top:22vw;'>With his story he found</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.1vw;text-align:center;'>greater inspiration.</div>",
                    
                 ],  
            }
        ],
        [ 13,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['toy1.png', 'toy2.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>As the lion is native to Africa</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>and Mbaye is an  African name.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left: 5vw;'>He thought that the design should</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left: 5vw;'>represent African designs</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left: 11vw;'>and influences.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left: 5vw;padding-top:2vw;'>He remembered how<span style='padding-left:35vw;'>toys in Africa were</span></div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;padding-left: 5vw;'>often made from<span style='padding-left:40vw;'>pieces of bent wire.</span></div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:left;padding-left: 5vw;'>Bent into the shapes <span style='padding-left:33vw;'>of animals of Africa.</span></div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:left;padding-left: 17vw;padding-top:1vw;'>Then he would make the<span style='padding-left:9vw;'>structure from a</span></div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:center;'> similar method. He would bend pipes	like pieces of wire.</div>",
                    "<div class='overlayTxt' id='txt11' style='height:3.7vw;text-align:center;'>Then between the pipes could go a panel or sheet to fill in the space. </div>"
                    
                 ],  
            }
        ],
        [ 14,{ 
            "collage":'',  
            "discImg":"pipeBending.png",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:3.5vw;text-align:left;padding-left: 5vw;'>These pipes were of large</div>",
                    "<div class='overlayTxt' id='txt2' style='height:3.5vw;text-align:left;padding-left: 5vw;'>diameter going from<span style='padding-left:32vw;'>50mm to 168mm.</span></div>",
                    "<div class='overlayTxt' id='txt3' style='height:3.5vw;text-align:left;padding-left: 5vw;'>He required a specialist<span style='padding-left:32vw;'>company to bend</span></div>",
                    "<div class='overlayTxt' id='txt4' style='height:3.5vw;text-align:center;padding-left: 33vw;'>them in a free-form</div>",
                    "<div class='overlayTxt' id='txt4' style='height:3.5vw;text-align:center;padding-left: 34vw;'>bent manner.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:left;padding-left: 5vw;'>They were not bent</div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.5vw;text-align:left;padding-left: 5vw;'>one way but in all</div>",
                    "<div class='overlayTxt' id='txt7' style='height:3.5vw;text-align:left;padding-left: 5vw;'>different directions<span style='padding-left:41vw;'>To North and East</span></div>",
                    "<div class='overlayTxt' id='txt7' style='height:3.5vw;text-align:left;padding-left: 5vw;'>of the globe.<span style='padding-left:49vw;'>then to West or</span></div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.5vw;text-align:center;padding-left:30vw;'>North-West then to</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.5vw;text-align:center;padding-left:27vw;'>South or South-East.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.5vw;text-align:left;padding-left:5vw;'>It was all very confusing.</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:center;font-size:2.8vw;padding-top:1vw;'>He had certainly designed a problem for himself.</div>"
                    
                 ],  
            }
        ],
        [ 15,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>So he and his team started to research how</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;padding-left: 3vw;'>they were going to bend these</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left: 3vw;'>pipes in such a manner.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left: 3vw;padding-top:3vw;'>They wrote to companies</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left: 3vw;'>all over the world and</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left: 3vw;'>visited possible</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;padding-left: 3vw;'>collaborators in China,</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:left;padding-left: 3vw;'>Switzerland and the UK.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:left;padding-left: 3vw'>Nobody could undertake </div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:left;padding-left: 3vw'>the work</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4vw;text-align:center;'>it was impossible to all.</div>",
                    
                 ],  
            }
        ],
        [ 16,{ 
            "collage":'collage-16-1.png',  
            "discImg":"",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:6vw;text-align:left;padding-left:5vw;padding-top:2vw;font-size:6vw;'>In China,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;font-size:3.5vw;'>the carpenter found himself</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>abandoned in a field by</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;padding-left: 20vw;'>a company who claimed</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;padding-left: 25vw;'>they could bend the pipes </div>",
                    "<div class='overlayTxt' id='txt6' style='height:8vw;text-align:center;padding-top:5vw;font-size:4vw;'>but actually</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;font-size:3.2vw;'>could not bend a</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;font-size:3.2vw;'>£10 note.</div>"
                    
                 ],  
            }
        ],
        [ 17,{ 
            "collage":'collage-17-1.png',  
            "discImg":"",
            "imagesUsed":['girls.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.2vw;text-align:center;padding-top:0vw;'><span style='font-size:5vw;'>He drove</span> through the pass of San Bernardino, Switzerland</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.2vw;text-align:center;font-size:4vw;'>in a snow storm</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.2vw;text-align:center;'>to a company lodged in amongst the Alps.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.2vw;text-align:left;padding-left:5vw;'>To find they could not bend more than 50mm pipes</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.2vw;text-align:right;'>and even that was not to the precision required.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.2vw;text-align:left;padding-left:20vw;font-size:3.5vw;'>He never gave up.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.2vw;text-align:center;padding-left:15vw;font-size:3.5vw;'>He never lost heart,</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.2vw;text-align:left;font-size:3.5vw;padding-left:5vw;'>he actually enjoyed every minute of it.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.2vw;text-align:center;padding-left:25vw;'>He and his team</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.2vw;text-align:left;padding-left:20vw;'>learnt at every step of  the</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4.2vw;text-align:center;padding-left:10vw;font-size:4vw;'>challenge.</div>"
                    
                 ],  
            }
        ],
        [ 18,{ 
            "collage":'collage-18-1.png',  
            "discImg":"",
            "imagesUsed":['collage-18-1.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5vw;text-align:left;padding-top:1vw;'><span style='font-size:5vw;padding-left:5vw;'>Eventually,</span>after so many calls and letters, </div>",
                    "<div class='overlayTxt' id='txt2' style='height:5vw;text-align:left;padding-left:11vw;'>they found a company in Scarborough,England </div>",
                    "<div class='overlayTxt' id='txt3' style='height:5vw;text-align:left;padding-left:5vw;'>who gave encouraging</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5vw;text-align:left;padding-left:5vw;'>logical ideas</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5vw;text-align:left;padding-left:5vw;'>and theories</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5vw;text-align:center; padding-left:20vw;padding-top:5vw;'>about building a machine that</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5vw;text-align:center;padding-left:15vw;font-size:5vw;padding-top:5vw;'>could bend these pipes.</div>"
                    
                 ],  
            }
        ],  
        [ 19,{ 
            "collage":'collage-19-1.png',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:left;padding-top:0vw;padding-left:2vw;'><span style='font-size:4vw;padding-right:5vw;'>So off</span>to England the carpenter flew</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;padding-left:10vw;'>straight into Birmingham Airport for the first time in his life.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:2vw;'>When he left Birmingham at 20 years of age </div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:right;'>he left in a very old car that had cost £11.40.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left:2vw;'>Which needed to stop every hour to top-up the water in the radiator</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center; padding-left:20vw;'>even though the temperature was freezing</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:right;padding-top:3vw;'>the car still overheated.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:left;padding-left:2vw;'>Now he returned in a different way than he left.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:right;'>Those streets of small heath had changed,</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:left;padding-left:2vw;'>all the heavy industries had gone along with the</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4vw;text-align:right;'>communities of back to back houses.</div>"
                    
                 ],  
            }
        ],  
        [ 20,{ 
            "collage":'collage-20-1.png',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:6vw;text-align:left;padding-top:1vw;padding-left:2vw;'>He drove up to North Yorkshires</div>",
                    "<div class='overlayTxt' id='txt2' style='height:6vw;text-align:right;'>to meet two delightful gentlemen,</div>",
                    "<div class='overlayTxt' id='txt3' style='height:6vw;text-align:left;padding-left:2vw;'>Allan Pickering and Julian Kidger</div>",
                    "<div class='overlayTxt' id='txt4' style='height:6vw;text-align:center;padding-left:20vw;'>of Unison.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:6vw;text-align:left;padding-left:2vw;'>Unlike other speculators of solutions</div>",
                    "<div class='overlayTxt' id='txt6' style='height:6vw;text-align:center; padding-left:20vw;'>Unison didn’t demand fortunes</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5vw;text-align:left;padding-left:2vw;'>upfront to</div>",
                    "<div class='overlayTxt' id='txt8' style='height:5vw;text-align:center;padding-left:10vw;'>engineer a solution.</div>"
                    
                 ],  
            }
        ],  
        [ 21,{ 														
            "collage":'',  
            "discImg":"",
            "imagesUsed":['allan.png','julian.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;padding-left:12vw;'>They politely listened to the carpenter and asked </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;padding-left:13vw;'>for a couple of months to make a proposal.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;padding-top:3vw;padding-left:11vw;'>They outlined that they were working with a</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;padding-left:20vw;'>technical college in Scarborough</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;padding-left:23vw;'>who taught disadvantaged youths</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;padding-left:25vw;'>and a university who would</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;padding-left:24vw;'>be honoured to be involved in </div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;padding-left:25vw;'>finding a solution for a</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:center;padding-left:25vw;'>machine to bend these pipes.</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:left;'>Because this was advancing engineering in a way</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4vw;text-align:center;'>not yet accomplished.</div>"         
                 ],  
            }
        ],  
        [ 22,{ 
            "collage":'',  
            "discImg":"pipeBending2.png",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:left;padding-left:5vw;'>They agreed to study together for a couple of months a</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;padding-left:5vw;'>design for the machine.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:5vw;'>Then if viable, they would</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left:5vw;'>build it.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:center;padding-left:30vw;'>Fortunately things</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:center;padding-left:30vw;'>progressed and a</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left:5vw;'> couple of months later</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;padding-left:5vw;'>the carpenter sent </div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:left;padding-left:5vw;'>Unison a payment</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:left;padding-left:5vw;'>for the engineering and</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:left;padding-left:5vw;'>building of the machine</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4vw;text-align:center;'>that could bend all the pipes how we required.</div>"
                    
                 ],  
            }
        ],  
        [ 23,{ 
            "collage":'collage-23-1.png',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>You can see it functioning at its unveiling in Scarborough.</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>And we wish to applaud</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>Mr. Alan Pickering  and his partner Julian Kidger</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>along with</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left:3vw;'>Matthew Bell,<span style='padding-left:50vw;'>Andrew Casson,</span></div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left:3vw;'>James Dobson, <span style='padding-left:50vw;'>Dave Asworth.</span></div>",
                    "<div class='overlayTxt' id='txt7' style='height:3.5vw;text-align:left;padding-left:3vw;'>These people worked</div>",
                    "<div class='overlayTxt' id='txt7' style='height:3.5vw;text-align:left;padding-left:3vw;'>with their team</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.5vw;text-align:left;padding-left:3vw;'>and our team</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.5vw;text-align:left;padding-left:3vw;'>particularly</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:center;'>Issabelleza Morales and her assistants</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:center;'>including Saju Dev and Eunice Gregorio.</div>"
                 ],  
            }
        ],  
        [ 24,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:left;padding-top:1vw;padding-left:5vw;'>Having designed the structure</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;padding-left:5vw;'>of Mbaye</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:5vw;'>from bent stainless steel pipes,</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left:5vw;'>we required something that</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:left;padding-left:5vw;'>filled the space between <span style='padding-left:25vw;'>This required something</span></div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:left;padding-left:5vw;'>those pipes.<span style='padding-left:45vw;'>aesthetically pleasing</span></div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.5vw;text-align:center;padding-left:30vw;'>and also appropriate</div>",
                    "<div class='overlayTxt' id='txt7' style='height:3.5vw;text-align:center;padding-left:30vw;'>for engineering reasons.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.5vw;text-align:left;padding-left:5vw;'>We wanted to be able to</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.5vw;text-align:left;padding-left:5vw;'>look up and see the stars </div>",
                    "<div class='overlayTxt' id='txt10' style='height:3vw;text-align:left;padding-left:5vw;'>and heavens <span style='padding-left:40vw;'>between her structure.</span></div>"
                 ],   
            }
        ], 
        [ 25,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['25panel1.png','25panel2.png','25panel3.png','25panel4.png','25panel5.png','25panel6.png',
                        '25panel7.png','25panel8.png','25panel9.png','25panel10.png','25panel11.png','25panel12.png',
                        '25panel13.png','25panel14.png','25panel15.png','25panel16.png','25panel17.png','25panel18.png',
                        '25panel1-s.png','25panel2-s.png','25panel3-s.png','25panel4-s.png','25panel5-s.png','25panel6-s.png',
                        '25panel7-s.png','25panel8-s.png','25panel9-s.png','25panel10-s.png','25panel11-s.png','25panel12-s.png',
                        '25panel13-s.png','25panel14-s.png','25panel15-s.png','25panel16-s.png','25panel17-s.png','25panel18-s.png',
                        ],
            "imagePos":[
                        {x:900,y:0,z:-700},{x:-500,y:300,z:-700},{x:300,y:350,z:-700},{x:-1100,y:-500,z:-1000},{x:0,y:-350,z:-500},{x:0,y:400,z:-900},
                        {x:-550,y:200,z:-300},{x:600,y:-250,z:-400},{x:600,y:250,z:-400},{x:-700,y:-50,z:-500},{x:500,y:-250,z:-600},{x:-350,y:-200,z:-500},
                        {x:-800,y:-400,z:-900},{x:450,y:150,z:-500},{x:300,y:-300,z:-700},{x:650,y:0,z:-600},{x:0,y:0,z:-800},{x:0,y:0,z:-50},
                        {x:900,y:0,z:-700},{x:-500,y:300,z:-700},{x:300,y:350,z:-700},{x:-1100,y:-500,z:-1000},{x:0,y:-350,z:-500},{x:0,y:400,z:-900},
                        {x:-550,y:200,z:-300},{x:600,y:-250,z:-400},{x:600,y:250,z:-400},{x:-700,y:-50,z:-500},{x:500,y:-250,z:-600},{x:-350,y:-200,z:-500},
                        {x:-800,y:-400,z:-900},{x:450,y:150,z:-500},{x:300,y:-300,z:-700},{x:650,y:0,z:-600},{x:0,y:0,z:-800},{x:0,y:0,z:-50},
                        ],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;padding-top:1vw;'>Hence the panels were to be with some form of holes</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>for us to see through and</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>also the wind to pass through</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>and make the noise of nature around the sculpture.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;padding-top:2vw;'>Thinking of the holes or perforations we needed.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>The carpenter said to himself,</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>\"Why do all the holes need to be the same?</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>That would represent geometry</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:center;'>not nature!\"</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:center;'>and hence would be wrong.</div>"
                 ],   
            }
        ],  
        [ 26,{  
            "collage":'',  
            "discImg":"",
            "imagesUsed":['boyBucket.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;padding-top:1vw;'>He remembered as a boy of 11years old </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>working in a shop,a flower shop</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>where his job was to empty the dirty water from</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>the buckets of the flowers and refill them.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;padding-top:7vw;'>It was hard work for a little boy</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>but he enjoyed the scent of the flowers</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>and was influenced by the fancy arrangements for</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>weddings, funerals,birthdays </div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:center;'>and all sorts of events the flowers were presented at.</div>"
                 ],   
            }
        ],
        [ 27,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['e1.png','e2.png','e3.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:3.7vw;text-align:center;'>Remembering these flowers</div>",
                    "<div class='overlayTxt' id='txt2' style='height:3.7vw;text-align:left;padding-left:30vw;'>and the ladies who embroidered</div>",
                    "<div class='overlayTxt' id='txt3' style='height:3.7vw;text-align:left;padding-left:30vw;'>flower patterns</div>",
                    "<div class='overlayTxt' id='txt4' style='height:3.7vw;text-align:left;padding-left:30vw;'>on cloths for</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.7vw;text-align:left;padding-left:30vw;'>decorating</div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.7vw;text-align:left;padding-left:30vw;'>clothing</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;padding-left:20vw;'>and table cloth</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.7vw;text-align:left;padding-left:3vw;'>he started to think of the</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.7vw;text-align:left;padding-left:3vw;'>relevance of all these flowers to our nature and how they are</div>",
                    "<div class='overlayTxt' id='txt10' style='height:3.7vw;text-align:left;padding-left:3vw;'>the elements of life that arealways trodden upon and discarded.</div>",
                    "<div class='overlayTxt' id='txt11' style='height:3.7vw;text-align:center;'>So he decided that the holes should be cut into the </div>",
                    "<div class='overlayTxt' id='txt12' style='height:3.7vw;text-align:center;'>shapes of petals and leaves of flowers.</div>",
                 ],
            }
        ], 
        [ 28,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['worldFlowers.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;padding-top:1vw;'>From here he decided</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>flowers from every country in the world</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'> would decorate the body of</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>Mbaye.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;padding-top:15vw;'>Every flower would be different,</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>every panel would be a different arrangement of flowers.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>Every nation’s national flower would be represented.</div>"		
                 ],
            }
        ],
        [ 29,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['christineAver.png','christianAver.png','sketch1.png','sketch2.png','sketch3.png','sketch4.png','sketch5.png','sketch6.png','sketch7.png','sketch8.png','sketch9.png','sketch10.png'],
            "imagePos":[{x:200,y:0,z:-400},{x:-150,y:-50,z:-400},{x:-1100,y:-550,z:-1500},{x:-1000,y:700,z:-2300},{x:1400,y:0,z:-2300},{x:700,y:750,z:-2000},{x:1000,y:-400,z:-1200},
                {x:-1300,y:500,z:-1500},{x:100,y:-700,z:-2000},{x:-300,y:500,z:-2500},{x:1100,y:450,z:-1200},{x:-1500,y:100,z:-2500}
                ],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;padding-top:1vw;'>We engaged firstly two young people from the Philippines,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;padding-left:5vw;font-size:4vw;'>Jan  and Christian,</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:5vw;'>who did some flowers</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left:5vw;'>then other members</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left:5vw;'>of our team who</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left:5vw;'>wanted to partake</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;padding-left:5vw;font-size:3vw;'>Issabeleza and Saju</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:left;padding-left:10vw;'>designed some</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:left;padding-left:13vw;'>firstly on paper</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:left;padding-left:20vw;'>then in the</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:left;padding-left:20vw;'>computer.</div>"
                 ],
            }
        ], 
        [ 30,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['1Protea.png','2Sunflower.png','3ArumLily.png','4ColoradoBlueColumbine.png','5AlpineColumbine.png','1A.png','2A.png','3A.png','4A.png','5A.png','avey.png','juliet.png','madonna.png','eda.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:3.8vw;text-align:left;padding-top:0.5vw;padding-left:14vw;'>Every leaf or petal of every flower of every</div>",
                    "<div class='overlayTxt' id='txt2' style='height:3.8vw;text-align:left;padding-left:17vw;'>bouquet of flowers is identified and coded.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:3.8vw;text-align:center;'>The pieces which are</div>",
                    "<div class='overlayTxt' id='txt4' style='height:3.8vw;text-align:center;'>cut out are kept to install</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.8vw;text-align:center;'>on a counter panel to be given</div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.8vw;text-align:left;padding-left:20vw;'>to the person who designed the boquet of every panel.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:3.8vw;text-align:left;padding-left:3vw;'>These are all unique and so nobody copies these panels,</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.8vw;text-align:left;padding-left:20vw;'>every petal is recognizable.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.8vw;text-align:left;padding-left:5vw;'>All of this required <span style='padding-left:40vw;'>a lot of research</span></div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.8vw;text-align:center;padding-left:32vw;'>and administering.</div>",
                    "<div class='overlayTxt' id='txt10' style='height:3.5vw;text-align:center;'>We must thank</div>",
                    "<div class='overlayTxt' id='txt11' style='height:3.5vw;text-align:center;font-size:3.7vw;'>Madona, Avey, Juliet and Eda for this.</div>"
                 ],
            }
        ], 
        [ 31,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5vw;text-align:center;padding-top:3vw;'>There are 594 body panels and 18 head panels.</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5vw;text-align:center;'>Each panel carries the name of the designer</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5vw;text-align:center;'>or someone we have attributed it to,</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5vw;text-align:center;'>including staff members</div>",
                    "<div class='overlayTxt' id='txt5' style='height:5vw;text-align:center;'>and</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5vw;text-align:center;'>persons who influenced our minds</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5vw;text-align:center;'>in designing and building</div>",  
                    "<div class='overlayTxt' id='txt8' style='height:5vw;text-align:center;'>this statue.</div>",
                 ],
            }
        ], 
        [ 32,{ 
            "collage":'collage-32-1.png',  
            "discImg":"",
            "imagesUsed":[],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5vw;text-align:left;padding-top:1vw;padding-left:3vw;'>The flowers are <span style='padding-left:35vw;'>laser-cut into</span></div>",
                    "<div class='overlayTxt' id='txt2' style='height:5vw;text-align:left;padding-left:3vw;'>stainless steel sheets<span style='padding-left:18vw;'>and then sandblasted</span></div>",
                    "<div class='overlayTxt' id='txt3' style='height:5vw;text-align:left;padding-left:3vw;'>and bent to shape <span style='padding-left:23vw;'>of the head or body.</span></div>",
                    "<div class='overlayTxt' id='txt4' style='height:5vw;text-align:left;padding-left:3vw;'>Thence mechanically <span style='padding-left:18vw;'>fitted to its location.</span></div>",
                    "<div class='overlayTxt' id='txt5' style='height:5vw;text-align:left;padding-left:3vw;'>Each panel should</div>",
                    "<div class='overlayTxt' id='txt6' style='height:5vw;text-align:left;padding-left:3vw;'>stay forever<span style='padding-left:35vw;'>or until some form</span></div>",
                    "<div class='overlayTxt' id='txt7' style='height:5vw;text-align:center;padding-left:30vw;'>of revolution</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5vw;text-align:center;padding-left:30vw;'>or rebellion</div>",
                    "<div class='overlayTxt' id='txt8' style='height:5vw;text-align:center;'>decides to dismantle her.</div>",
                 ],
            }
        ],
        [ 33,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['33view1.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:10vw;text-align:center;padding-top:1vw;'>As we have 594 different bouquets of flowers</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5vw;text-align:left;padding-left:7vw;'>to install on her body.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:9vw;text-align:center;padding-left:27vw;padding-top:4vw;'>We thought.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:10vw;text-align:left;padding-left:10vw;'>Who could help</div>",
                    "<div class='overlayTxt' id='txt5' style='height:7vw;text-align:center;'>with the designing of each panel.</div>",
                 ],
            }
        ],
        [ 34,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['34photo.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>Then we thought, why ask one or two people</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;padding-left:2vw'>and why from one country or two.<span style='padding-left:14vw;'>Surely someone is capable</span></div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:2vw'>of designing a panel<span style='padding-left:39vw;'>given the right tools</span></div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left:10vw'>in every country <span style='padding-left:41vw;'>in the world.</span></div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left:2vw'>So why not ask everyone <span style='padding-left:45vw;'>in the world</span></div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;padding-left:32vw;'>if they would like</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;padding-left:34vw;'>to design a panel.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.5vw;text-align:left;padding-left:2vw'>So that is what</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.5vw;text-align:left;padding-left:2vw'>we are doing.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.5vw;text-align:left;padding-left:2vw'>We want someone from <span style='padding-left:39vw;'>every country</span></div>",
                    "<div class='overlayTxt' id='txt10' style='height:3.5vw;text-align:left;padding-left:2vw'>in the world to design <span style='padding-left:39vw;'>at least one panel.</span></div>",
                    "<div class='overlayTxt' id='txt11' style='height:3.5vw;text-align:center;'>Can you? Just go to design a panel.</div>",
                 ],
            }
        ],
        [ 35,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;font-size:3.5vw;'>During designing Mbaye statue,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;'>the carpenter recognized <span style=''>that if the feet were made of</span></div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;'>stainless steel the same as her body,</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;'>then visitors would burn their hands if they touched.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;'>her on hot days.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;'>This was not acceptable as</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;'>she needed to be loved<span style=''>and she needed to</span></div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>consider others who may</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>wish to embrace her.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:left;'>Hence, the feet were</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:left;'>designed in marble which</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:center;'>would stay cool even on the hottest of summer days.</div>"
                 ],
            }
        ],
        [ 36,{ 
            "collage":'collage-36-1.png',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>Thence one day, the carpenter went off to Carrara in Italy to find </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>what he required. Italy was familiar to the carpenter as his wife  </div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>and children were born there.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>He met up with Mr. Daniele Pardini and Mr. Franco Petachi at </div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>their quarry in the Tuscan mountains close to a beautiful village</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>called Colonnada, famous for certain culinary delights. Franco and </div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>Daniele were accompanied by a fantastic sculptor called Francesca </div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>Bernardini who was very encouraging. together they chose the </div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:center;padding-top:3vw;'>blocks of marble from the vast mountains that have been excavated </div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:center;'>over thousands of years. </div>"
                 ],
            }
        ],

        [ 37,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>He met up with Mr. Daniele Pardini and Mr. Franco Petachi at their</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>quarry in the Tuscan mountains close to a beautiful village called</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>Colonnada, famous for certain culinary delights. Franco and Daniele</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>were accompanied by a fantastic sculptor called Francesca Bernardini</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>who was very encouraging. together they chose the blocks of marble</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>from the vast mountains that have been excavated over thousands of</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>years.</div>"
                 ],
            }
        ],
        [ 38,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>Having chosen the marble, it was taken down the mountain to be</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>cut and carved to the basic shape of the feet the carpenter had</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>designed initially in clay, polystyrene then he had these 3D copied</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>into computer software.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>Thence these 3D designs could be converted to robotic software to</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>undertake the basic shape of the foot carving by a computer </div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>numerically-controlled robot.</div>"
                 ],
            }
        ],
        [ 39,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>During designing Mbaye statue, the carpenter recognized that if </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>the feet were made of stainless steel the same as her body,</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>then visitors would burn their hands if they touched her on hot days.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>This was not acceptable as Mbaye needed to be loved and she needed</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>to consider others who may wish to embrace her.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>Hence, the feet were designed in marble which would stay cool </div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>even on the hottest of summer days.</div>"
                 ],
            }
        ],
        [ 40,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>During designing Mbaye statue, the carpenter recognized that if </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>the feet were made of stainless steel the same as her body,</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>then visitors would burn their hands if they touched her on hot days.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>This was not acceptable as Mbaye needed to be loved and she needed</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>to consider others who may wish to embrace her.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>Hence, the feet were designed in marble which would stay cool </div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>even on the hottest of summer days.</div>"
                 ],
            }
        ],
    ]
);
