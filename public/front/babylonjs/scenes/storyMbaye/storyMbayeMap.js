let clickableFlowersMap = new Map([
    [ "40PetuniaExserta-2.png","12Buttercup"],
    [ "40westerncolumbine-2.png","23WesternColumbine"],
    [ "40protea-2.png","1Protea"],
    [ "40sweetpea-2.png","77SweetPea"],
    [ "40petunia-2.png","28Petunia"],
]);


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
            "discImg":"",
            "imagesUsed":['pipeBending2.png'],
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
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;padding-left:2vw;'>the carpenter recognized <span style='padding-left:13vw;'>that if the feet were made of</span></div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:2vw;'>stainless steel the same as <span style='padding-left:24vw;'>her body,</span></div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left:2vw;'>then visitors would burn<span style='padding-left:27vw;'>their hands if they touched.</span></div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;padding-left:30vw;'>her on hot days.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left:2vw;'>This was not acceptable as</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;padding-left:2vw;'>she needed to be loved<span style='padding-left:36vw;'>and she needed to</span></div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;padding-left:33vw;'>consider others who may</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;padding-left:34vw;'>wish to embrace her.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.5vw;text-align:left;padding-left:2vw;'>Hence, the feet were</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.5vw;text-align:left;padding-left:2vw;'>designed in marble which</div>",
                    "<div class='overlayTxt' id='txt10' style='height:3.5vw;text-align:center;'>would stay cool even on the hottest of summer days.</div>"
                 ],
            }
        ],
        [ 36,{ 
            "collage":'collage-36-1.png',  
            "discImg":"",
            "imagesUsed":['36photo2.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:5.5vw;text-align:center;padding-top:2vw;'>We required the best marble in the world</div>",
                    "<div class='overlayTxt' id='txt2' style='height:5.5vw;text-align:center;padding-left:15vw;'>and so if Michelangelo of Italy</div>",
                    "<div class='overlayTxt' id='txt3' style='height:5.5vw;text-align:left;padding-left:2vw;'>would use white marble from Carrara Italy</div>",
                    "<div class='overlayTxt' id='txt4' style='height:5.5vw;text-align:left;padding-left:2vw;'>then so might we.<span style='padding-left:25vw;'>We considered</span></div>",
                    "<div class='overlayTxt' id='txt5' style='height:5.5vw;text-align:left;padding-left:2vw;'>alternatives <span style='padding-left:33vw;'>but no the best was</span></div>",
                    "<div class='overlayTxt' id='txt6' style='height:5.5vw;text-align:center;padding-left:39vw;'>required.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:5.5vw;text-align:left;padding-left:2vw;'>For us no doubt the best was from</div>",
                    "<div class='overlayTxt' id='txt8' style='height:5.5vw;text-align:center;padding-left:30vw;'>Carrara Italy.</div>"
                ],
            }
        ],
        [ 37,{ 
            "collage":'collage-37-1.png',
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;font-size:4vw;'>Thence one day, the carpenter went off to Carrara</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>in Italy to find  what he required.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:2vw;'>Italy was familiar to the carpenter as his wife and children</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;padding-left:35vw;'>were born there.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left:2vw;'>He met up with Mr. Daniele Pardini and Mr. Franco Petachi</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left:2vw;'>at their quarry in the Tuscan mountains close to a beautiful village</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>called Colonnada, famous for certain culinary delights.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;padding-left:5vw;'>Franco and Daniele were accompanied by a fantastic sculptor</div>",
                    "<div class='overlayTxt' id='txt9' style='height:3.5vw;text-align:center;padding-left:5vw;'>called Francesca Bernardini who was very encouraging.</div>",
                    "<div class='overlayTxt' id='txt10' style='height:3.5vw;text-align:center;padding-left:5vw'>Together they chose the blocks of marble from the</div>",
                    "<div class='overlayTxt' id='txt11' style='height:3.5vw;text-align:center;'>vast mountains that have been excavated</div>",
                    "<div class='overlayTxt' id='txt12' style='height:3.5vw;text-align:center;padding-left:25vw;font-size:4vw;'>over thousands of years. </div>"
                 ],
            }
        ],

        [ 38,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['38photo-1.png','38photo-2.png','38photo-3.png','38photo-4.png','38photo-5.png'],
            "imagePos":[{x:0,y:10,z:-20},{x:-210,y:70,z:-210},{x:-140,y:-50,z:-130},{x:150,y:-50,z:-120},{x:190,y:70,z:-180}],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.5vw;text-align:center;font-size:4vw;'>Having chosen the marble,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.5vw;text-align:center;'>it was taken down the mountain to be</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.5vw;text-align:left;padding-left:3vw;padding-top:10vw;'>cut and carved to the basic <span style='padding-left:20vw;'>shape of the feet</span></div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.5vw;text-align:left;padding-left:10vw;'>the carpenter</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.5vw;text-align:center;'>had molded initially in clay and</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.5vw;text-align:center;padding-left:14vw;'>polystyrene</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.5vw;text-align:center;'>then he had these 3D copied</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.5vw;text-align:center;padding-left:7vw;'>into a computer software.</div>"
                 ],
            }
        ],																															
        [ 39,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[],
            "imagePos":[],
            "video":['39FootProduction.mp4'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:3.7vw;text-align:left;padding-left:2vw;'>Thence these 3D designs could</div>",
                    "<div class='overlayTxt' id='txt2' style='height:3.7vw;text-align:left;padding-left:2vw;'>be converted to robotic software</div>",
                    "<div class='overlayTxt' id='txt3' style='height:3.7vw;text-align:left;padding-left:2vw;'>to undertake the basic shape</div>",
                    "<div class='overlayTxt' id='txt4' style='height:3.7vw;text-align:left;padding-left:2vw;'>of the foot carving by</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.7vw;text-align:left;padding-left:2vw;'>a computer</div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.7vw;text-align:left;padding-left:2vw;'>numerically-controlled robot.<span style='padding-left:30vw;'>This carving</span></div>",
                    "<div class='overlayTxt' id='txt7' style='height:3.7vw;text-align:center;padding-left:30vw;'>took almost six months</div>",
                    "<div class='overlayTxt' id='txt8' style='height:3.7vw;text-align:center;padding-left:33vw;'>for one foot.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:center;'>You can see here.</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4vw;text-align:left;padding-left:2vw;'>During this time we looked continuously at our designs</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4vw;text-align:left;padding-left:10vw;'>contemplating how we could make them</div>",
                    "<div class='overlayTxt' id='txt12' style='height:4vw;text-align:center;padding-left:30vw;font-size:4vw;'>more beautiful.</div>",
                 ],
            }
        ],
        [ 40,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['40westerncolumbine.png','40PetuniaExserta.png','40petunia.png','40sweetpea.png','40chickweed.png','40westerncolumbine-2.png','40PetuniaExserta-2.png','40petunia-2.png','40sweetpea-2.png','40chickweed-2.png'],
            "imagePos":[{x: 400, y: 20, z: -500},{x: -630, y: 200, z: -500},{x: -1000, y: -300, z: -500},{x: 950, y: 150, z: -500},{x: 950, y: -350, z: -500},
                        {x: 400, y: 20, z: -495},{x: -630, y: 200, z: -495},{x: -1000, y: -300, z: -495},{x: 950, y: 150, z: -495},{x: 950, y: -350, z: -495}
            ],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.5vw;text-align:left;padding-left:2vw;'>Dreaming of lions</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.5vw;text-align:left;padding-left:10vw;'>walking through a wilderness of flowers</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.5vw;text-align:center;'>all over the world,</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.5vw;text-align:left;padding-left:15vw;'>we choose to continue our theme</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.5vw;text-align:center;padding-left:15vw;'>of incorporating flowers over the</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.5vw;text-align:center;padding-left:20vw;'>body of Mbaye into the feet.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.5vw;text-align:left;padding-left:2vw;'>Thence we took our designs of flowers</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.5vw;text-align:center;padding-left:10vw;'>from flat designs into 3D models</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.5vw;text-align:center;padding-left:10vw;'>that could be printed in 3D.</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.5vw;text-align:left;padding-left:10vw;'>Thence also carved by robots.</div>"
                 ],
            }
        ],
        [ 41,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.5vw;text-align:left;font-size:5vw;padding-left:2vw;'>Overtime,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.5vw;text-align:left:padding-left:20vw;;'>we designed and formatted over two hundred flowers</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.5vw;text-align:left;padding-left:2vw;'>that could be scaled up or down in size</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.5vw;text-align:center;padding-left:20vw;'>and be placed around the feet</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.5vw;text-align:left;padding-left:2vw;'>as per our desires and sentiments.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.5vw;text-align:center;padding-left:25vw;'>Rather than arrange them,</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.5vw;text-align:left;padding-left:2vw;'>we choose to scatter them</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.5vw;text-align:center;padding-left:15vw;'>as if they had been thrown on the feet</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.5vw;text-align:left;padding-left:2vw;'>rather like they had been thrown as seeds in a field of</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.5vw;text-align:center;padding-left:10vw;font-size:5vw;'>eternal growth.</div>"
                 ],
            }
        ],
        [ 42,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['worldFlowers.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.5vw;text-align:left;padding-left:2vw;'>There are flowers<span style='padding-left:15vw;'>from every country in the world</span></div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.5vw;text-align:center;padding-left:27vw;'>including every nation’s </div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.5vw;text-align:center;padding-left:29vw;'>national flower</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.5vw;text-align:center;padding-left:31vw;'>and all are included</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.5vw;text-align:center;padding-left:32vw;'>on the feet.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.5vw;text-align:left;padding-left:2vw;'>No carving is the same.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.5vw;text-align:left;padding-left:8vw;'>You can find your</div>",
                    "<div class='overlayTxt' id='txt8' style='height:5vw;text-align:left;padding-left:2vw;'>national flower by going to all</div>",
                    "<div class='overlayTxt' id='txt9' style='height:5vw;text-align:left;padding-left:3vw;'>of these flowers</div>",
                    "<div class='overlayTxt' id='txt10' style='height:5vw;text-align:center;'>or just click here.</div>",
                ],
            }
        ],
        [ 43,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['43photo.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.5vw;text-align:center;padding-left:25vw;'>The robotic carving</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.5vw;text-align:center;padding-left:25vw;'>was undertaken in Italy</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.5vw;text-align:left;padding-left:3vw;'>but the final manual finished carving</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.5vw;text-align:center;padding-left:15vw;'>was undertaken in Dubai by a team</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.5vw;text-align:left;padding-left:3vw;'>trained by the carpenter who</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.5vw;text-align:left;padding-left:3vw;'>followed every single flower</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.5vw;text-align:left;padding-left:3vw;'>in its design by computer</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.5vw;text-align:left;padding-left:3vw;'>to its final polishing.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.5vw;text-align:left;padding-left:3vw;'>He can carve and can polish but he</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.5vw;text-align:center;'>cannot produce what was required in a computer.</div>",
                 ],
            }
        ],
        [ 44,{ 
            "collage":'collage-44-1.png',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.5vw;text-align:left;padding-left:3vw;'><span style='font-size:4.5vw;'>The carpenter</span> could not build Mbaye all on his own.</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.5vw;text-align:center;'>He needed help,advice and expertise</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.5vw;text-align:left;padding-left:3vw;font-size:4vw;'>that he admitted, he never possessed.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.5vw;text-align:left:padding-left:5vw;'>He could not carve, bend, and weld all that was required.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.5vw;text-align:left;padding-left:3vw;'>He was also required in many other sectors to build this</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.5vw;text-align:center;font-size:4vw;'>monument.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.5vw;text-align:left;padding-top:7vw;padding-left:3vw;'>It is why he has chosen to remove his name from her</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.5vw;text-align:center;'>but add those of all others who contributed in good faith. </div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.5vw;text-align:center;font-size:2.5vw;'>Those who were in bad faith are best forgotten.</div>",
                 ],
            }
        ],
        [ 45,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['45photoSaju.png','45photoFiroj.png','45photoVidya.png','45photoPeter.png'],
            "imagePos":[{x:0,y:-70,z:-100},{x:-450,y:180,z:-200},{x:300,y:180,z:-250},{x:500,y:-120,z:-300}],
            "texts":["<div class='overlayTxt' id='txt1' style='height:3.5vw;text-align:left;padding-left:2vw;'><span style='font-size:4vw;'>The carving</span> of these flowers</div>",
                     "<div class='overlayTxt' id='txt2' style='height:3.5vw;text-align:center;padding-left:8vw;'>required help from many people</div>",
                    "<div class='overlayTxt' id='txt3' style='height:3.5vw;text-align:center;padding-left:8vw;'>who you can see in our pictures.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left:2vw;'>The credit of the work</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left:2vw;'>is for all involved including those like the sculptor</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:left;padding-left:2vw;'>Francesca Bernardini</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:left;padding-left:2vw;'>who gave some nice advice. <span style='padding-left:15vw;'>As did all the professionals</span></div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;padding-left:25vw;'>in this field and in many fields</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4vw;text-align:center;padding-left:27vw;'>we walked for inspiration</div>",
                    "<div class='overlayTxt' id='txt10' style='height:3.5vw;text-align:center;padding-left:28vw;'>and advice.</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4vw;text-align:left;padding-left:2vw;'>We wish to here recognize the great works of</div>",
                    "<div class='overlayTxt' id='txt12' style='height:4vw;text-align:center;font-size:4vw;'>Saju, Firoj,Peter and Vidya.</div>",
                 ],
            }
        ],
        [ 46,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['44photo.png'],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:left;padding-left:2vw;'>We utilized the natural anatomy of the lioness</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:left;padding-left:2vw;'>to create the structure</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:left;padding-left:2vw;'>that would hold up</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:left;padding-left:2vw;'>the weight of the</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:left;padding-left:2vw;'>120 tons of Mbaye.<span style='padding-left:5vw;'>This, as you can see, has been designed</span></div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;padding-left:22vw;'>to follow the bones of the lioness'</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;padding-left:30vw;'>legs and joints,</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;padding-left:30vw;'>up to her back bone.</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.5vw;text-align:left;padding-left:2vw;'>They are made from stainless steel</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.5vw;text-align:center;padding-left:5vw;'>and pass right through her marble feet</div>",
                    "<div class='overlayTxt' id='txt11' style='height:4.5vw;text-align:center;'>to the foundations.</div>"
                ],
            }
        ],
        [ 47,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4.5vw;text-align:left;padding-left:2vw;'>You can see that the feet</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4.5vw;text-align:center;padding-left:15vw;'>have holes passing right through them.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4.5vw;text-align:left;padding-left:2vw;'>We also show you the designs of the</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4.5vw;text-align:left;padding-left:2vw;'>internal bone structure.<span style='padding-left:25vw;'>The full engineered</span></div>",
                    "<div class='overlayTxt' id='txt5' style='height:4.5vw;text-align:left;padding-left:2vw;'>calculations of this structure</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4.5vw;text-align:left;padding-left:2vw;'>cannot yet be undertaken</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4.5vw;text-align:center;padding-left:15vw;'>until we have chosen her final location.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4.5vw;text-align:left;padding-left:2vw;'>Though the outline has been approved</div>",
                    "<div class='overlayTxt' id='txt9' style='height:4.5vw;text-align:center;padding-left:30vw;'>by independent</div>",
                    "<div class='overlayTxt' id='txt10' style='height:4.5vw;text-align:center;'>structural analysts.</div>",
                ],
            }
        ],

        [ 48,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":['48photo1.png','48photo2.png','48photo3.png','48photo4.png','48photo5.png'],
            "imagePos":[{x:-580,y:230,z:-700},{x:-600,y:-250,z:-750},{x:20,y:-10,z:-250},{x:500,y:-180,z:-800},{x:500,y:200,z:-600}],
            "texts":["<div class='overlayTxt' id='txt1' style='height:3.5vw;text-align:center;'>The head of a Mbaye</div>",
                    "<div class='overlayTxt' id='txt2' style='height:3.5vw;text-align:center;'>was another great feat overcoming</div>",
                    "<div class='overlayTxt' id='txt3' style='height:3.5vw;text-align:center;'>the difficulties of her size</div>",
                    "<div class='overlayTxt' id='txt4' style='height:3.5vw;text-align:center;padding-left:20vw;'>and of those who</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:center;padding-left:30vw;'>proposed helping us.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.5vw;text-align:left;padding-left:2vw;'>We tried many people’s</div>",
                    "<div class='overlayTxt' id='txt1' style='height:3.5vw;text-align:left;padding-left:2vw;;'>offers but dismissed all. <span style='padding-left:20vw;'>Preferring to rely on people we</span></div>",
                    "<div class='overlayTxt' id='txt3' style='height:3.5vw;text-align:center;padding-left:28vw;'>taught ourselves and we</div>",
                    "<div class='overlayTxt' id='txt4' style='height:3.5vw;text-align:center;padding-left:25vw;'>ourselves honestly learnt</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:center;padding-left:20vw;'>from the better parts of</div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.5vw;text-align:center;padding-left:20vw;'>those who advised us.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:3.5vw;text-align:left;padding-left:2vw;;'>Dismissing many of their ill intentions.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:3.5vw;text-align:left;padding-left:2vw;'>Some were personal opinions.</div>",
                ],
            }
        ],

        [ 49,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>Everyone had their idea how the ears or eyes, mouth or nose </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>should be. Changing our ideas for their own. Others took funds </div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>for work and never completed obligations.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>Some people who worked with us just could not follow our moral code.</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>It’s correct to mention that in building Mbaye, we learnt from many</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>people. We learnt we could not give a sketch or drawing of her head</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>and have someone produce it as we wanted. They naturally change</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>works and details.</div>"
                ],
            }
        ],

        [ 50,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>Hence, the shape of the face had to be designed in 3D by a 3D </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>design genius. Several persons helped with this, not just one man.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>Due to each man really having other ambitions in life and maybe </div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>not fully believing in the vision of the carpenter, the designs</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>were passed from one 3D genius to another as the carpenter </div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>insisted on the face telling the sentiments he wanted portrayed.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>We thank you Franky, Saju and Sethu.</div>"
                ],
            }
        ],
        [ 51,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>We did not want an aggressive, growling lioness but a peaceful,</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>young mother content in herself - smiling or almost laughing. </div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>Her head is proportionally a little big. Just as young animals  </div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>appear to have. Similar to the feet, if you ever noticed.</div>"
                ],
            }
        ],
        [ 52,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>Most of all, the surface of her face is covered again</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>with the flowery mesh panels giving a decoration,which maybe </div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>female lions would like to have. Just as young girls </div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>sometimes have too much makeup, maybe Mbaye also</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>has too much decoration on her face.</div>"
                ],
            }
        ],
        [ 53,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>From scaling her, we could then 3D-print her in any size.</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>We required them in a format that we could 3D-print her </div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>in her full size of almost 5-meter-high head.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>With this, we needed to produce a mould to shape stainless </div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>steel sheets to. </div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>We discovered through trial and error that our best method </div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>was to build that mould in 18mm thick layers of MDF.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>Thence, we could build a mould hollow on the inside.</div>",
                ],
            }
        ],
        [ 54,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>No matter what, it was a formidable task. To make the mould</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>for the entire head in layers of 18mm, considering over 5 meters</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>height of her head, we would require 277 layers of MDF</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>all fitting together. </div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>As the mould was built, we needed to shape the thick </div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>stainless steel sheets to that mould. There was no press and die</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>machine that could do this, so every millimetre of her </div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>had to be cut, hammered, welded and grinded by hand </div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>thence polished.</div>",
                ],
            }
        ],
        [ 55,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>We had some great metal carpenters working for us who </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>had shown great service and love to their works.</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>Including Ibrahim and Babul from Bangladesh who</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>had been with us for many years and worked on</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>some of the most prestigious buildings in the world including </div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>the Burj Khalifa.</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>They were accompanied by many others including </div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>Devenand , Firoj, Vidya, IK, Iftekhar,Peter,</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>Chisom,Benjamin,Kenneth,  Jonard, Gabriel and Obinna.</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>Each one of them learning to do something they have never done before.</div>",
                ],
            }
        ],
        [ 56,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>The welding of stainless steel is very, very difficult. </div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>Only TIG welding is good enough and few welders</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>can TIG-weld to the quality we required.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>The weld needs to pass from one side to the other</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>and avoid distortion over its length. So we must diffuse the heat </div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>or its passes to all other areas of the metal surface and the shape</div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>distorts. </div>",
                ],
            }
        ],
        [ 57,{ 
            "collage":'',  
            "discImg":"",
            "imagesUsed":[''],
            "texts":["<div class='overlayTxt' id='txt1' style='height:4vw;text-align:center;'>Even the polishing can distort the shape we have produced</div>",
                    "<div class='overlayTxt' id='txt2' style='height:4vw;text-align:center;'>by concentrating too much in one area creating excessive heat</div>",
                    "<div class='overlayTxt' id='txt3' style='height:4vw;text-align:center;'>that passes to another area.</div>",
                    "<div class='overlayTxt' id='txt4' style='height:4vw;text-align:center;'>We had incorporated some structural greater strength in the panels</div>",
                    "<div class='overlayTxt' id='txt5' style='height:4vw;text-align:center;'>of the face by utilizing some pipes around the flower patterns.</div>",
                    "<div class='overlayTxt' id='txt6' style='height:4vw;text-align:center;'>These helped greatly in the rigidity of the face. These pipes were </div>",
                    "<div class='overlayTxt' id='txt7' style='height:4vw;text-align:center;'>connected to the internal structure that sustained the</div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>weight of five tons of the head </div>",
                    "<div class='overlayTxt' id='txt8' style='height:4vw;text-align:center;'>which was to be connected to the back bone of the body of Mbaye.</div>"
                ],
            }
        ],
        
         
         
       
        
         
         
        
         
        
        
        
        
         
        
         
        
        
         
         
         
        
        
        
        
        
         
        
 
 


 



         







 


         





        





        


 



 

 
        

    ]
);
