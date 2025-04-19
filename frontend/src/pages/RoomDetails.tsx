import { Typography, Container } from '@mui/material'
import { useParams } from 'react-router-dom'

function RoomDetails() {
  const { id } = useParams()

  return (
    <Container>
      <Typography variant="h4" component="h1" gutterBottom>
        Room Details {id}
      </Typography>
      {/* TODO: Add room details */}
    </Container>
  )
}

export default RoomDetails 