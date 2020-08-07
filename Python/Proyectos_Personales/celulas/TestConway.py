import unittest
from Conway import Conway

class TestConway (unittest.TestCase):

    def testRefineDrawing(self):
        conway = Conway("dosPorDos")
        expected = [
            [1,-1],
            [-1,1]
        ]
        self.assertEqual(expected,conway.initialCondition)

    def testCorrectSize(self):
        conway = Conway("rayas")
        self.assertEqual(10,conway.gridSize)
        conway = Conway("dosPorDos")
        self.assertEqual(2,conway.gridSize)

    def testCurrentActiveCells(self):
        conway = Conway("dosPorDos")
        expected = [[0,0],[1,1]]
        self.assertEqual(expected,conway.currentActiveCells)

    def testSwitchCell(self):
        conway = Conway("dosPorDos")
        conway.switchCell([[0,0],[0,1]])
        expected = [
            [-1,1],
            [-1,1]
        ]
        self.assertEqual(expected,conway.currentGeneration)
    
    def testGetNeighbourCells(self):
        conway = Conway('rayas')
        neighbours = conway.getNeighbourCells([1,1])
        values = []
        for neighbour in neighbours:
            values.append(conway.currentGeneration[neighbour[0]][neighbour[1]])
        expected = [1,1,1,-1,-1,1,1,1]
        self.assertEqual(expected,values)


if __name__ == '__main__':
    unittest.main()