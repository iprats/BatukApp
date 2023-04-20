const express = require('express');
const router = express();
const Band = require('../classes/Band');
const User = require('../classes/User');
const Instrument = require('../classes/Instrument');

const genericUserBody = {
    include: [
        {
            model: Band,
            through: {
                attributes: []
            },
            attributes: {
                exclude: ["createdAt", "updatedAt"]
            }
        },
        {
            model: Instrument,
            attributes: {
                exclude: ["createdAt", "updatedAt"]
            }
        }
    ],
    attributes: {
        exclude: ["createdAt", "updatedAt"]
    }
}

/** GET ALL USERS **/
router.get('/band/:band_idband', (req, res) => {
    User.findAll({
        include: [
            {
                model: Band,
                where: {
                    idband: req.params.band_idband
                },
                through: {
                    attributes: []
                },
                attributes: {
                    exclude: ["createdAt", "updatedAt"]
                }
            },
            {
                model: Instrument,
                attributes: {
                    exclude: ["createdAt", "updatedAt"]
                }
            }
        ]
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

/** GET ALL USERS **/
router.get('/email/:email', (req, res) => {
    User.findAll({
        ...genericUserBody,
        where: {
            email: req.params.email
        }
    })
    .then(result => res.json(result))
    .catch(error => res.send(error).status(500))
})

module.exports = router;