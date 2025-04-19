import { Routes, Route, Navigate } from 'react-router-dom'
import { ThemeProvider, createTheme } from '@mui/material'
import { useAuthStore } from './store/authStore'
import Layout from './components/Layout'
import Login from './pages/Login'
import Register from './pages/Register'
import Buildings from './pages/Buildings'
import BuildingDetails from './pages/BuildingDetails'
import Rooms from './pages/Rooms'
import RoomDetails from './pages/RoomDetails'
import QRScanner from './pages/QRScanner'

const theme = createTheme({
  palette: {
    primary: {
      main: '#1976d2',
    },
    secondary: {
      main: '#dc004e',
    },
    background: {
      default: '#f5f5f5',
      paper: '#ffffff',
    },
  },
  typography: {
    fontFamily: '"Roboto", "Helvetica", "Arial", sans-serif',
    h1: {
      fontSize: '2.5rem',
      fontWeight: 500,
    },
    h2: {
      fontSize: '2rem',
      fontWeight: 500,
    },
    h3: {
      fontSize: '1.75rem',
      fontWeight: 500,
    },
  },
})

function App() {
  const { isAuthenticated } = useAuthStore()

  return (
    <ThemeProvider theme={theme}>
      <Routes>
        {/* Public routes */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/qr-scanner" element={<QRScanner />} />

        {/* Protected routes */}
        <Route
          path="/"
          element={
            isAuthenticated ? (
              <Layout />
            ) : (
              <Navigate to="/login" replace />
            )
          }
        >
          <Route index element={<Buildings />} />
          <Route path="buildings" element={<Buildings />} />
          <Route path="buildings/:id" element={<BuildingDetails />} />
          <Route path="rooms" element={<Rooms />} />
          <Route path="rooms/:id" element={<RoomDetails />} />
        </Route>
      </Routes>
    </ThemeProvider>
  )
}

export default App 