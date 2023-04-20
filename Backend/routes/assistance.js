const express = require('express');
const router = express();
const Assistance = require('../classes/Assistance')

// TO GET ANSWER ENUM VALUES USE <Assistance.rawAttributes.answer.values>

router.put('/:event_idevent', (req, res) => {
    Assistance.update({
        answer: req.body.answer, 
        instrument_idinstrument: req.body.instrument_idinstrument
    }, {
        where: {
            user_iduser: req.body.user_iduser,
            event_idevent: req.params.event_idevent
        }
    })
    .then(result => res.json(result).status(200))
    .catch(error => res.error(error))
})

router.get('/responses', (_req, res) => {
    res.json(Assistance.rawAttributes.answer.values)
})

module.exports = router