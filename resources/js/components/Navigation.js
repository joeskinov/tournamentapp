import React from 'react';
import ReactDOM from 'react-dom';
// import the progress bar
import StepProgressBar from 'react-step-progress';
// import the stylesheet
import 'react-step-progress/dist/index.css';

function Navigation() {
    console.log(competition);
    let steps = competition.rounds.map((comp, i) => ({
        label: 'Round ' + (i + 1),
        subtitle: (i/(competition.rounds.length-1) * 100).toFixed(2) + '%',
        name: 'round ' + i,
        content: <StepContent matches={comp.matches} winner={comp.winner} />
        }));
    
    
    function onFormSubmit() {
        // handle the submit logic here
        // This function will be executed at the last step
        // when the submit button (next button in the previous steps) is pressed
    }
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">{competition.competition_name}</div>
                        <StepProgressBar
                            startingStep={0}
                            onSubmit={onFormSubmit}
                            steps={steps}
                        />
                    </div>
                </div>
            </div>
        </div>
    );
}

function StepContent({matches, winner}) {

    return (
        <div className="row mt-5" style={{marginRight: 2}}>
            {
                matches.map((match , i) => (
                        <div key={i} className="col-md-4 card">
                            <div className="card-header">
                                Winner : {match.winner.player_name}
                            </div>
                            <div className="card-body">
                                {
                                    match.players.map((player, j) => (
                                        <p key={j}>{player.player_name}</p>
                                    ))
                                }
                            </div>
                        </div>
                ))
            }
        </div>
    )
}

if (document.getElementById('navigation')) {
    ReactDOM.render(<Navigation />, document.getElementById('navigation'));
}
