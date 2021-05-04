import {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';

function CompetitionForm() {
    const [competitionName, setCompetitionName] = useState('');
    const [contNum, setContNum] = useState('');
    const [roundsNum, setRoundsNum] = useState('');
    const [contestants, setContestants] = useState([]);

    const changeContestants = (e) => {
        setContNum(e.target.value);
        let c = []
        for(let i = 0; i < parseInt(e.target.value); i++){
            c.push(i);
        }
        setContestants(c);
    }
    const changeRounds = (e) => {
        let val = e.target.value;
        if(parseInt(contNum) <= 3){
            val = parseInt(contNum) - 1 + '';
        }
        setRoundsNum(val);
    }

    const ChangeCompetitionName = (e) => {
        setCompetitionName(e.target.value);
    }


    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <form method="POST" action="/newcompetition">
                        <input type="hidden" name="_token" value={csrf_token} />
                        <div className="form-group">
                            <label htmlFor="competitionname">{'competition Name'}</label>
                            <input type="text" name="competitionname" onChange={ChangeCompetitionName} value={competitionName} className="form-control" id="competitionname" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="contestantsnum">{'N° of Contestants'}</label>
                            <input type="number" onChange={changeContestants} value={contNum} className="form-control" id="contestantsnum" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="roundsnum">{'N° of Rounds'}</label>
                            <input type="number" name="rounds" onChange={changeRounds} value={roundsNum} className="form-control" id="roundsnum" />
                        </div>
                        
                        <div className='card'>
                            {
                                contestants.map((c) => (
                                    <div key={c} className="form-group">
                                        <label htmlFor="roundsnum">{`Contestant ${c + 1} Name`}</label>
                                        <input type="text" className="form-control" name={`contestants[]`} />
                                    </div>
                                ))
                            }
                        </div>
                        <button type="submit" className="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    );
}

export default CompetitionForm;

if (document.getElementById('competition-form')) {
    ReactDOM.render(<CompetitionForm />, document.getElementById('competition-form'));
}
