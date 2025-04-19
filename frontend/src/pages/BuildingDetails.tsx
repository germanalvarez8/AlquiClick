import { Typography, Container } from '@mui/material'
import { useParams } from 'react-router-dom'

function BuildingDetails() {
  const { id } = useParams()

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Building Details {id}
      </Typography>
      {/* TODO: Add building details */}
    </Container>
  )
}

export default BuildingDetails 